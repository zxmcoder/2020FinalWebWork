<?php

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use think\Request;

class Ticket extends Common {

    public function showticket() {
        $tickets = db('ticket')->select();
        $this->assign("tickets", $tickets);
        return $this->fetch();
    }

    public function delticket() {
        $ticket_id = input('get.ticket_id');
        if(!$ticket_id) 
            $this->error('必选项为空');
        $ticket = db('ticket')->field('ticket_id, ticket_num')->where('ticket_id', $ticket_id)->find();
        if(!$ticket) {
            $this->error('想要删除的火车票不存在');
        }
        db('ticket')->where('ticket_id',$ticket_id)->delete();
        return $this->success('删除火车票'.$ticket_id.'成功','main/index');
    }

    public function findticket() {
        $ticket_id = input('post.ticket_id');
        if(!$ticket_id) 
            $this->error('必选项为空');
        $ticket = db('ticket')->field('ticket_id, ticket_num')->where('ticket_id', $ticket_id)->find();
        if(!$ticket){
            $this->error('没有这种火车票');
        }
        else {
            $this->assign("ticket", $ticket);
            return $this->fetch();
        }
    }

    public function updateticket() {
        if(Request::instance()->isGet()) {
            $ticket_id = input('get.ticket_id');
            // var_dump($ticket_id);
            $ticket = db('ticket')->field('ticket_id, ticket_num')->where('ticket_id', $ticket_id)->find();
            if(!$ticket) 
                $this->error('火车票不存在');
            $this->assign("ticket_num", $ticket['ticket_num']);
            $this->assign("ticket_id", $ticket_id);
            return $this->fetch();
        }
        else {
            $ticket_id = input('post.ticket_id');
            $ticket_num = input('post.ticket_num');
            $one_new_ticket_num = input('post.one_new_ticket_num');
            $two_new_ticket_num = input('post.two_new_ticket_num');
            // var_dump($ticket_id);
            // var_dump($ticket_num);
            // var_dump($one_new_ticket_num);
            // var_dump($two_new_ticket_num);
            if(!$ticket_id || !$ticket_num || !$one_new_ticket_num || !$two_new_ticket_num)
                $this->error('必填项不完整');
            if($one_new_ticket_num != $two_new_ticket_num)
                $this->error('修改数量不一致');
            if($one_new_ticket_num == $ticket_num)
                $this->error('未修改');
            if($one_new_ticket_num < 0)
                $this->error('火车票数量不可小于0');
            $ticket = db('ticket')->field('ticket_id, ticket_num')->where('ticket_id', $ticket_id)->find();
            if(!$ticket)
                $this->error('要修改的火车票不存在');
            if($ticket['ticket_num'] != $ticket_num)
                $this->error('非法错误');
            db('ticket')->where('ticket_id',$ticket_id)->setField('ticket_num',$one_new_ticket_num);
            return $this->success('修改火车票'.$ticket_id.'数量为'.$one_new_ticket_num.'成功','main/index');
        }
    }

    public function addticket() {
        if(Request::instance()->isGet()) {
            return $this->fetch();
        }
        else {
            $ticket_id = input('post.ticket_id');
            $one_ticket_num = input('post.one_ticket_num');
            $two_ticket_num = input('post.two_ticket_num');
            // var_dump($ticket_id);
            // var_dump($one_ticket_num);
            // var_dump($two_ticket_num);
            if(!$ticket_id || !$one_ticket_num || !$two_ticket_num)
                $this->error('必填项为空');
            if($one_ticket_num != $two_ticket_num)
                $this->error('两次输入的数量不一致');
            //判断加入的火车票id是否符合规范
            $ids = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            if(!in_array($ticket_id, $ids))
                $this->error('火车票命名错误，A-Z的字母');
            if(!is_numeric($one_ticket_num))
                $this->error('数量参数输入错误');
            $ticket = db('ticket')->field('ticket_id, ticket_num')->where('ticket_id', $ticket_id)->find();
            if($ticket)
                $this->error('火车票已存在');
            $addticket[] = ['ticket_id'=>$ticket_id,'ticket_num'=>$one_ticket_num];
            db('ticket')->insertAll($addticket);
            return $this->success('添加火车票'.$ticket_id.'成功', 'ticket/addticket');
        }
    }
}