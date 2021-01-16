<?php

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use think\Request;

class User extends Common {

    public function showuser() {
        $users = db('user')->select();
        $this->assign("users", $users);
        return $this->fetch();
    }

    public function deluser() {
        $user_id = input('get.user_id');
        if(!$user_id) 
            $this->error('必选项为空');
        $user = db('user')->field('user_id, user_ticket')->where('user_id', $user_id)->find();
        if(!$user) {
            $this->error('想要删除的用户不存在');
        }
        db('user')->where('user_id',$user_id)->delete();
        return $this->success('删除用户'.$user_id.'成功','main/index');
    }

    public function finduser() {
        $user_id = input('post.user_id');
        if(!$user_id) 
            $this->error('必选项为空');
        $user = db('user')->field('user_id, user_ticket')->where('user_id', $user_id)->find();
        if(!$user){
            $this->error('没有这个用户');
        }
        else {
            $this->assign("user", $user);
            return $this->fetch();
        }
    }
}