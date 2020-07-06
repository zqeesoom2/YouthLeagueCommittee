<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Froum;
use app\admin\model\org;
use app\admin\model\OrgActivity;
use app\BaseController;
use app\mobile\model\Member;
use think\facade\Db;
use think\facade\Session;
use think\Request;
use think\facade\View;
use think\facade\Config;


class Index extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {

        $objFroum =  new Froum();
        $objOrgActivity = new OrgActivity();
        $uid = Session::get('uid');


        if ($uid==1) {
            $arrWhere['status'] = 0;
            $arrWhere2 = '';

        }else {

            $arrWhere['status'] = 1;
            $arrWhere['group_id'] = $uid;

            $arrWhere2[0] = ['status','=',6];
            $arrWhere2[1] = ['privil','like',Session::get('privil').'%'];
         }




        View::assign([
            "noAuditNews" => $objFroum->noAuditStatistics($arrWhere),
            'noAuditActiv' => $objOrgActivity->noAuditStatistics($arrWhere2),
            'privil' => Session::get('privil')
        ]);

        return  View::fetch();
    }

    public function user(Request $request)
    {

        $show = '';
        if (!empty($request->post('password'))) {


            $arrCreate = $request->post();

            try{
                Db::startTrans();
                $obj = new \app\mobile\model\Org();

                if ( $arrCreate['username'] && empty($obj->orgByName($arrCreate['username']))) {


                    $arrCreate['path'] = '-'.$arrCreate['service_id'];
                    $arrCreate['service'] = $arrCreate['service_id'];
                    $arrCreate['status'] = 1;


                    $password = md5($arrCreate['password'].Config::get('cus.salt'));
                    $username = $arrCreate['username'];

                    $arrCreate['org_name'] = $arrCreate['username'];

                    unset($arrCreate['password2']);
                    unset($arrCreate['password']);
                    unset($arrCreate['service_id']);
                    unset($arrCreate['username']);


                    $arr = $obj->add($arrCreate);

                    (new \app\mobile\model\Admin())->add(['username'=>$username,'password'=>$password,'privil'=>$arrCreate['path'],'org_id'=>$arr['data']['org_id']]);


                    Db::commit();

                    return  json($arr);
                }

                return json( ['code'=>0,'message'=>'账号名已存在']);

            } catch (\Exception $e) {
                Db::rollback();
                return json( ['code'=>0,'message'=>$e->getMessage()]);
            }

        }


        return  View::fetch();
    }

    /**
     * 列出组织中的成员
     *
     *
     */
    public function volunteer(Request $request, $oid=0)
    {

        $strPri = Session::get('privil');

        if ($oid){
            $objOrg = new org();

            $arr = $objOrg->getMemberById($oid);

            View::assign([
                'privil' => $strPri,
                'arrVolunteer'=>$arr,
                'count'=> count($arr)
            ]);
            return View::fetch();

        }else{

            $count = 0;

            $objMember = new Member();

            $arrVolunteer =  $objMember->list($strPri);

            if ($arrVolunteer)
                $count = $arrVolunteer->total();

            View::assign([
                'privil' => $strPri,
                'arrVolunteer'=>$arrVolunteer,
                'count'=>$count
            ]);
            return View::fetch();
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
    public function editAccout(Request $request)
    {
        $post = $request->post();

        $msg = '提交失败';
        $code = 1;

       if ( (new Member())->editLengthSer($post['id'],['status'=>$post['status']]) ){
           $msg = '提交成功';
           $code = 0;
       }

       return  json(['code'=>$code,'message'=>$msg]);
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
