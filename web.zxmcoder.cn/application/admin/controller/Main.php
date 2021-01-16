<?php

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use think\Request;

class Main extends Common {

    public function index() {
        return $this->fetch();
    }

    public function logout() {
        session('role', null);
        session('login_id', null);
        session('is_change_password', null);
        $this->success('退出成功', 'login/index');
    }

    public function password() {
        if(Request::instance()->isGet()) {
            return $this->fetch();
        }
        else {
            $code = input('captcha');
            if (!captcha_check($code)) {
                $this->error('验证码错误');
            }
            
            $login_id = input('post.login_id');
            $old_password = input('post.old_password');
            $new_password_one = input('post.new_password_one');
            $new_password_two = input('post.new_password_two');
            // 参数安全校验
            if(!$old_password || !$new_password_one || !$new_password_two) 
                $this->error('必填项不完整');
            if(session('login_id') != $login_id)
                $this->error('非法操作');
            if($new_password_one != $new_password_two)
                $this->error('两次输入的新密码不一致');
            if(strlen($new_password_one) < 6)
                $this->error('密码长度必须要大于等于6位');
            if(session('role') == 'superadmin') {
                $true_password = db('superadmin')->field('superadmin_password')->where('superadmin_id', session('login_id'))->find()['superadmin_password'];
                if($true_password != md5(md5($old_password).'md5salt'))
                    $this->error('旧密码输入错误');
                if($new_password_one == $old_password)
                    $this->error('新密码和旧密码一致');
                db('superadmin')->where('superadmin_id', session('login_id'))->setField('superadmin_password', md5(md5($new_password_one).'md5salt'));
                db('superadmin')->where('superadmin_id', session('login_id'))->setField('is_change_password', 1);
                session('role', null);
                session('login_id', null);
                session('is_change_password', null);
                $this->success('修改密码成功，请重新登录', 'login/index');
            }
            if(session('role') == 'worker') {
                $true_password = db('worker')->field('worker_password')->where('worker_id', session('login_id'))->find()['worker_password'];
                if($true_password != md5(md5($old_password).'md5salt'))
                    $this->error('旧密码输入错误');
                if($new_password_one == $old_password)
                    $this->error('新密码和旧密码一致');
                db('worker')->where('worker_id', session('login_id'))->setField('worker_password', md5(md5($new_password_one).'md5salt'));
                db('worker')->where('worker_id', session('login_id'))->setField('is_change_password', 1);
                session('role', null);
                session('login_id', null);
                session('is_change_password', null);
                $this->success('修改密码成功，请重新登录', 'login/index');
            }
            $this->error('修改密码失败');
        }
    }

}