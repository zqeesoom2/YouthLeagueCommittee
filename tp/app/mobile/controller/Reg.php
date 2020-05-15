<?php
declare (strict_types = 1);

namespace app\mobile\controller;

use app\mobile\model\Org;
use think\facade\Session;
use think\Request;
use app\mobile\model\Member;
use think\facade\View;

class Reg
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {



        return View::fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {
        $arrCreate = $request->post();
        $arrCreate['username'] = Session::get('userInfo')['username'];
        $arrGroupId= json_decode($arrCreate['group']);


        $objM = new Member();
        //$objO = new Org();

        if (empty($objM->memberByName($arrCreate['username']))) {
            //$arrCreate['group'] = $objO->splicingPath($arrCreate['group']);
            unset($arrCreate['group']);
            $arr = $objM->add($arrCreate,$arrGroupId);

            return  json($arr);
        }

        return json( ['state'=>1,'message'=>'已激活']);

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
