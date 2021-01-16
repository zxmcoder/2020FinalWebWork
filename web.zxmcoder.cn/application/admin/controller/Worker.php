<?php

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use think\Request;

class Worker extends Common {

    public function showworker() {
        $workers = db('worker')->select();
        $this->assign("workers", $workers);
        return $this->fetch();
    }

    public function delworker() {
        $worker_id = input('get.worker_id');
        // var_dump($worker_id);
        if(!$worker_id) 
            $this->error('必选项为空');
        $worker = db('worker')->field('worker_id, is_change_password')->where('worker_id', $worker_id)->find();
        if(!$worker) {
            $this->error('想要删除的worker不存在');
        }
        db('worker')->where('worker_id',$worker_id)->delete();
        return $this->success('删除worker——'.$worker_id.'成功','main/index');
    }

    public function findworker() {
        $worker_id = input('post.worker_id');
        if(!$worker_id) 
            $this->error('必选项为空');
        $worker = db('worker')->field('worker_id, is_change_password')->where('worker_id', $worker_id)->find();
        if(!$worker){
            $this->error('没有这个工作人员');
        }
        else {
            $this->assign("worker", $worker);
            return $this->fetch();
        }
    }

    public function addworker() {
        if(Request::instance()->isGet()) {
            return $this->fetch();
        }
        else {
            $one_worker_id = input('post.one_worker_id');
            $two_worker_id = input('post.two_worker_id');
            // var_dump($one_worker_id);
            // var_dump($two_worker_id);
            if(!$one_worker_id || !$two_worker_id)
                $this->error('必填项为空');
            if($one_worker_id != $two_worker_id)
                $this->error('两次输入的账号不一致');
            // 判断加入的worker_id是否符合规范
            // 正则表达式判断
            if(strlen($one_worker_id) != 10 || !preg_match("#^[a-z]*$#", $one_worker_id))
                $this->error('账号命名不符合规范');
            $worker = db('worker')->field('worker_id, is_change_password')->where('worker_id', $one_worker_id)->find();
            if($worker)
                $this->error('worker_id已存在');
            $addworker[] = ['worker_id'=>$one_worker_id,'worker_password'=>md5(md5($one_worker_id).'md5salt'),'is_change_password'=>0];
            db('worker')->insertAll($addworker);
            return $this->success('添加工作人员'.$one_worker_id.'成功', 'worker/addworker');
        }
    }

}