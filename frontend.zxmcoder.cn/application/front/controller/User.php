<?php

namespace app\front\controller;

use think\Controller;
use think\Loader;
use think\Request;

class User extends Controller {

    public function register() {
        if(Request::instance()->isGet()) {
            if(session('user_id')) {
                $this->success('你已登入', 'user/showticket');
            }
            else
                return $this->fetch();
        }
        else {
            if(session('user_id')) {
                $this->success('你已登入', 'user/showticket');
            }
            else {
                $code = input('captcha');
                if (!captcha_check($code)) {
                    $this->error('验证码错误');
                }
                $user_id = input('post.user_id');
                $one_user_password = input('post.one_user_password');
                $two_user_password = input('post.two_user_password');
                if(!$user_id || !$one_user_password || !$two_user_password) {
                    $this->error('必填项不完整');
                }
                if($one_user_password != $two_user_password) {
                    $this->error('两次密码不一致');
                }
                //user账号必须要是10位数字组成的字符串
                if(strlen($user_id) != 10 || !preg_match("#^[0-9]*$#", $user_id))
                    $this->error('账号命名不符合规范，必须0-9的10位字符串');
                //密码长度必须大于等于6
                if(strlen($one_user_password) < 6)
                    $this->error('密码长度必须大于等于6');
                $user = db('user')->field('user_id, user_password')->where('user_id', $user_id)->find();
                if($user)
                    $this->error('账号已经存在');
                $adduser[] = ['user_id'=>$user_id,'user_password'=>md5(md5($one_user_password).'md5salt')];
                db('user')->insertAll($adduser);
                return $this->success('添加账号'.$user_id.'成功，请登录', 'user/login');
            }
        }
    }

    public function login() {
        if(Request::instance()->isGet())  {
            if(session('user_id')){
                return $this->success('你已登入', 'user/showticket');
            }
            else {
                return $this->fetch();
            }
        }
        else {    
            if(session('user_id')){
                return $this->success('你已登入', 'user/showticket');
            }
            else {
                $code = input('captcha');
                if (!captcha_check($code)) {
                    $this->error('验证码错误');
                }
                $user_id = input('post.user_id');
                $user_password = input('post.user_password');

                if (!$user_id || !$user_password) {
                    $this->error('必填项不完整');
                }
                //判断登录
                $user = db('user')->field('user_id, user_password')->where('user_id', $user_id)->find();
                if($user && $user['user_password'] == md5(md5($user_password).'md5salt')) {
                    session('user_id', $user_id);
                    return $this->success("登录成功，欢迎你".$user_id, 'user/showticket');
                }
                $this->error("账号或密码不正确");
            }
        }
    }

    public function buyticket() {
        if(session('user_id')) {
            $tickets = db('ticket')->select();
            $this->assign("tickets", $tickets);
            return $this->fetch();
        }
        else {
            $this->error('未登录，请登录', 'user/login');
        }
    }

    public function dobuyticket() {
        if(session('user_id')) {
            $ticket_id = input('get.ticket_id');
            if(!$ticket_id) {
                $this->error('参数为空');
            }
            else{
                // 这里需要考虑一个问题……发过来的参数确实没有余票怎么办？
                // 前端虽然做了限制，但是还是可以过来的
                // 但在这里不查数据库……为了避免影响性能
                // 利用redis记录，30s内抢过票的等一等结果

                $redis = new \Redis();
                $redis->connect('127.0.0.1', 6379);
                $redis->incr(session('user_id'));
                $redis->expire(session('user_id'),10);
                if($redis->get(session('user_id')) > 1) {
                    return $this->error('请等待', 'user/buyticket');
                }
                // 逻辑走到这里，代表不是重复的抢票请求了。
                // 可以丢给go程序去写数据库了
                // 发送user_id和tikcet_id给go程序
                $ticket_id = input('get.ticket_id');
                if(!session('user_id') || !$ticket_id)
                    $this->error('参数为空');
                $data['user_id'] = session('user_id');
                $data['ticket_id'] = $ticket_id;
                $data_str = json_encode($data);
                $url = '129.211.57.153:39999/api/ticketorder';
                $ch = curl_init($url); //初始化curl
                curl_setopt($ch, CURLOPT_MAXREDIRS, 20); //页面跳转次数
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且不输出到屏幕上
                curl_setopt($ch, CURLOPT_POST, 1); //post提交方式---
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 10); // 在尝试连接时等待的秒数
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_str); //提交数据
                // 设置json头
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length: ' . strlen($data_str))
                );
                // curl_exec($ch);
                // curl_close($ch);
                
                $contents = curl_exec($ch);
                curl_close($ch);
                var_dump($contents);
                $contents_arr = json_decode($contents, true);
                if($contents_arr['code']==200) {
                    return $this->success('抢票订单提交成功，稍后查看结果。', 'user/buyticket');
                }
                else {
                    return $this->error('抢票订单提交失败，请重试。', 'user/buyticket');
                }
            }
        }
        else {
            $this->error('未登录，请登录', 'user/login');
        }
    }

    public function showticket() {
        if(session('user_id')) {
            $user_id = session('user_id');
            if(!$user_id) 
                $this->error('参数为空');
            $user = db('user')->field('user_id, user_ticket')->where('user_id', $user_id)->find();
            if(!$user){
                $this->error('没有这个用户');
            }
            else {
                $this->assign("user", $user);
                return $this->fetch();
            }
        }
        else {
            $this->error('未登录，请登录', 'user/login');
        }
    }

    public function logout() {
        if(session('user_id')){
            session('user_id', null);
            return $this->success('登出成功', 'user/login');
        }
        else {
            $this->error('请登录', 'user/login');
        }
    }

    // public function test_settimeout() {
    //     $redis = new \Redis();
    //         $redis->connect('127.0.0.1', 6379);
    //     $redis->incr("username2");
    //         $redis->expire("username2",20);  //设置过期时间，单位秒
    //     echo $redis->get("username2");
    // }
}