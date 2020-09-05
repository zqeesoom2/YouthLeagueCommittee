<?php


namespace app\controller;



use think\facade\Request;

class Index
{
    public function index()
    {

        if(Request::isMobile()){
            return redirect((string)url('mobile/index'));
        }else{
            return redirect((string)url('pc/index'));
        }
    }
}