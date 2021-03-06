<?php
declare (strict_types = 1);

namespace app\admin\controller;



use think\Request;
use think\facade\View;
use think\facade\Db;
use think\facade\Config;
use think\facade\Session;
class Login
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {

        $show = '';
        if (!empty($request->post('submit'))) {
             $strSalt =  Config::get('cus.salt');
             $password = md5($request->post('password').$strSalt);
             $username = $request->post('username');
             $arrUser = Db::name('admin')->where([
                 'username'=>$username,
                 'password'=>$password
             ])->find();

             if ($arrUser){

                 Session::set('privil',$arrUser['privil']);

                 $arr = array_filter(explode('-',$arrUser['privil']));

                 Session::set('service',array_shift($arr));
                 Session::set('ordId',$arrUser['org_id']);
                 Session::set('username',$username);
                 Session::set('uid',$arrUser['Id']);

                return redirect((string) url('adminIndex'));
             }
             else{
                 $show = 'fail';
             }

        }
        view::assign('show',$show);
        return  View::fetch();
    }




    public function out()
    {

        Session::delete('privil');
        Session::delete('uid');
        Session::delete('service');
        Session::delete('ordId');
       return redirect((string) url('login/index'));
    }


}
