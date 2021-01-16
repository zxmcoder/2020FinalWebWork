<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->redirect('http://frontend.zxmcoder.cn/front/user/login',302);
    }
}
