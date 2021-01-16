<?php

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use think\Request;

class Login extends Controller {

    public function index() {
        if(Request::instance()->isGet())  {
            if(session('role') && session('login_id')){
                return $this->success('你已登入', 'main/index');
            }
            else {
                return $this->fetch();
            }
        }
        else {
            if(session('role') && session('login_id')){
                return $this->success('你已登入', 'main/index');
            }
            else {
                $code = input('captcha');
                if (!captcha_check($code)) {
                    $this->error('验证码错误');
                }
                $login_id = input('post.login_id');
                $login_password = input('post.login_password');
                // 判断输入时候为空，返回模糊的逻辑
                // 前端做了判断，后端也要继续做判断
                if (!$login_id || !$login_password) {
                    $this->error('必填项不完整');
                }
                //判断是否是SuperAdmin登录
                $superadmin = db('superadmin')->field('superadmin_id, superadmin_password, is_change_password')->where('superadmin_id', $login_id)->find();
                if($superadmin && $superadmin['superadmin_password'] == md5(md5($login_password).'md5salt')) {
                    session('login_id', $login_id);
                    session('role', 'superadmin');
                    session('is_change_password', $superadmin['is_change_password']);
                    //这里还需要记录登录信息
                    $addlog[] = ['log_person'=>$login_id,'log_role'=>'superadmin','log_time'=>time(),'log_ip'=>request()->ip(),'log_url'=>request()->path()];
                    db('log')->insertAll($addlog);

                    if($superadmin['is_change_password'] == 0)
                        $this->success("登录成功，SuperAdmin未修改默认密码", 'main/index');
                    else
                        $this->success("登录成功，SuperAdmin已修改默认密码", 'main/index');
                }
                //判断是否是Worker登录
                $worker = db('worker')->field('worker_id, worker_password, is_change_password')->where('worker_id', $login_id)->find();
                if($worker && $worker['worker_password'] == md5(md5($login_password).'md5salt')) {
                    session('login_id', $login_id);
                    session('role', 'worker');
                    session('is_change_password', $worker['is_change_password']);
                    //这里还需要记录登录信息
                    $addlog[] = ['log_person'=>$login_id,'log_role'=>'worker','log_time'=>time(),'log_ip'=>request()->ip(),'log_url'=>request()->path()];
                    db('log')->insertAll($addlog);
                    if($worker['is_change_password'] == 0)
                        $this->success("登录成功，Worker未修改默认密码", 'main/index');
                    else
                        $this->success("登录成功，Worker已修改默认密码", 'main/index');
                }
                $this->error("账号或密码不正确");
            }
        }
    }

}
