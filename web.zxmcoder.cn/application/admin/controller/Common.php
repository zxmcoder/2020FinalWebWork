<?php

namespace app\admin\controller;

use think\Controller;

class Common extends Controller {

    public function __construct(\think\Request $request = null) {
        parent::__construct($request);
        // echo 'url with domain: ' . $request->url(true) . '<br/>';
        // echo md5(md5('abcdefghij').'md5salt');
        // echo time();
        // echo(date("Y-m-d-H:i:s",time()));
        // echo $request->ip();

        // 未登录的用户不允许进行除了登录之外的任何操作
        if (!session('role') || !session('login_id')) {
            $this->error('请登录', 'login/index', '', 0);
        }

        // 权限检查is_change_password
        // 没有修改默认密码的情况下，会进行警告
        if(session('is_change_password')==0)
            echo "请修改默认密码以免造成损失！";

        // 权限检查RBAC
        // worker能执行main,ticket,user
        // superadmin能执行main,worker,log
        // Login.php没有继承Common.php这个类

        $controller = strtolower(request()->controller());

        if(session('role')=='worker' && ($controller == 'worker' || $controller == 'log'))
            $this->error('权限不足，访问失败', 'main/index', '', 1);
        if(session('role')=='superadmin' && ($controller == 'user' || $controller == 'ticket'))
            $this->error('权限不足，访问失败', 'main/index', '', 1);

        //记录log，每一次操作都要记录下来
        // var_dump(request()->path());
        $addlog[] = ['log_person'=>session('login_id'),'log_role'=>session('role'),'log_time'=>time(),'log_ip'=>request()->ip(),'log_url'=>request()->path()];
        db('log')->insertAll($addlog);
        
    }
}