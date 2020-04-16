<?php
declare (strict_types = 1);

namespace app\mobile\controller;

use app\mobile\model\Member;
use app\mobile\model\Admin;
use app\mobile\model\Org;
use think\facade\Config;
use think\facade\Session;
use think\Request;
use think\facade\View;
use think\facade\Db;


class Index
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $arrM = (new Member() )->memberByName(Session::get('userInfo')['username']);

        View::assign('me',$arrM);
        return View::fetch();
    }

    public function login()
    {

        return View::fetch();
    }

    public function orgReg(){
        return View::fetch();
    }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {

        if (isset($_FILES['fileImg']) ) {
            $arrImg =upload_img('fileImg');
            return json(['state'=>0,'logo_url'=>'/storage/'.$arrImg]);
        }

        $arrCreate = $request->post();
        try{
            Db::startTrans();
            $obj = new Org();
            if ( $arrCreate['org_name'] && empty($obj->orgByName($arrCreate['org_name']))) {

                $arrPerOrg = $obj->getPath($arrCreate['service']);

                $arrCreate['path'] = $arrPerOrg->path.$arrCreate['service'].'-';

                $password = md5($arrCreate['password'].Config::get('cus.salt'));
                $username = $arrCreate['org_name'];
                unset($arrCreate['password']);

                $objAdmin = (new Admin())->add(['username'=>$username,'password'=>$password,'org_id'=>$arrCreate['path']]);

                $arr = $obj->add($arrCreate);

                Db::commit();

                return  json($arr);
            }

            return json( ['state'=>1,'message'=>'团队名已存在']);

        } catch (\Exception $e) {
            Db::rollback();
            return json( ['state'=>1,'message'=>$e->getMessage()]);
        }





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

    public function getStatus(Request $request) {
        $id = $request->request('id');

        if($id){
            $obj =  (new Org())->getStatusById($id);
            if ($obj->status) {
                return '已审核通过';
            }else{
                return '审核中';
            }
        }
    }
}
