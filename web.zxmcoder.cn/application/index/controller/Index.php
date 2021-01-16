<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->redirect('http://web.zxmcoder.cn/admin/login',302);
    }
}
