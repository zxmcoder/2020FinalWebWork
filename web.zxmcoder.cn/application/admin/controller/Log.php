<?php

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use think\Request;
use think\Db;

class Log extends Common {

    public function showlog() {
        // $logs = db('log')->select()->paginate(10);
        $logs = Db::name('log')->paginate(10);
        // $logs['log_time'] = date("Y-m-d-H:i:s",$logs['log_time']);
        $this->assign("logs", $logs);
        return $this->fetch();
    }
}