<?php
declare (strict_types = 1);

namespace app\home\controller;

use think\Request;
use think\facade\Db;
use think\facade\View;
use think\facade\Config;

class login
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function login(Request $request)
    {


        if ($request->isPost()) {
            $strSalt =  Config::get('cus.salt');
            $password = md5($request->param('password').$strSalt);
            $username = $request->param('username');
            $arrUser = Db::name('admin')->where([
                'username'=>$username,
                'password'=>$password
            ])->find();

            if ($arrUser){
                return json(['state'=>0,'data'=>'登陆成功！']);
            }
            else
                return json(['state'=>1,'data'=>'登陆失败！']);
        }

        return  View::fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
