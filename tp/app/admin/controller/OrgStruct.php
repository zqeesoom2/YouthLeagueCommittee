<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Session;
use think\Request;
use think\facade\Db;
use think\facade\View;
use app\admin\model\org;

class OrgStruct
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $arrOrg = make_tree((new org())->likeListOrg(Session::get('privil')));
        View::assign('arrOrg',$arrOrg);
        View::assign('privil',Session::get('privil'));

        return View::fetch();
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
    public function update(Request $request)
    {
        $strAccount = $request->post('org_name');

        return  json((new org())->editorg($request->post()));
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
