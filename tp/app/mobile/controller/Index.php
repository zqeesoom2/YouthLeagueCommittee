<?php
declare (strict_types = 1);

namespace app\mobile\controller;

use app\admin\model\Froum;
use app\admin\model\OrgActivity;
use app\mobile\model\Member;
use app\mobile\model\Admin;
use app\mobile\model\Org;
use app\mobile\model\OrgActivUid;
use think\Exception;
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
        $arrM = '';
        //$arrM = (new Member() )->memberByName(Session::get('userInfo')['username']);

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

    function loginOut(Request $request) {

        if ($request->isPost())
            Session::delete('userInfo');
        return json(['status'=>0]);
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

                $arrCreate['path'] = $obj->splicingPath($arrCreate['service']);
                $arrCreate['parent_id'] = $arrCreate['service'];

                $password = md5($arrCreate['password'].Config::get('cus.salt'));
                $username = $arrCreate['org_name'];
                unset($arrCreate['password']);

                $arr = $obj->add($arrCreate);

               //
                // $objAdmin = (new Admin())->add(['username'=>$username,'password'=>$password,'org_id'=>$arrCreate['path'].$arr['data']['org_id'].'-']);
                $objAdmin = (new Admin())->add(['username'=>$username,'password'=>$password,'privil'=>$arrCreate['path'],'org_id'=>$arr['data']['org_id']]);


                Db::commit();

                return  json($arr);
            }

            return json( ['state'=>1,'message'=>'团队名已存在']);

        } catch (\Exception $e) {
            Db::rollback();
            return json( ['state'=>1,'message'=>$e->getMessage()]);
        }
    }


    public function enroll(Request $request) {

        $id = (int) $request->get('id');
        $uid = (int) $request->get('uid');
        $group =  $request->get('group');
        $f = true;
        if ( $id && $uid ) {

            $arrS = (new Member())->getMemberById($uid,'',true);
            foreach ($arrS->service->toArray() as $val){
               if($val['org_name']==$group){
                   $f = false;
                   continue;
               }

            }

            if($f)
               return json(['code'=>1,'data'=>'账号服务类型不匹配']);

            if ($arrS->status=='待审核'){
                return json(['code'=>1,'data'=>'账号待审核不能报名']);
            }



           /* if ($arrS->group!=$group){
                return json(['code'=>1,'data'=>'账号服务类型错误']);
            }*/

            $msg = '已报名成功';
            $obj = new OrgActivUid();
            $arr = $obj->findOne($id,$uid);

            if (empty($arr)) {

               $objD = $obj->add(['org_act_id'=>$id,'uid'=>$uid]);
               if ($objD){

                   (new OrgActivity())->incEnroll($id);

               }else{

                   $msg = '报名失败';
               }


            }
            return json(['code'=>1,'data'=>$msg]);
        }


    }

    public function details(Request $request)
    {
        $id = $request->get('id');

        if ($id){
            $info = (new OrgActivity())->whichOne($id,1);
            View::assign('info',$info);
            return  View::fetch();
        }
    }

    public function content (Request $request){

        $id = $request->get('id');
        if ($id){
            $info = (new Froum())->getOne($id,1);
            View::assign('info',$info);
            return  View::fetch();
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($index)
    {

        $arrlist = (new OrgActivity())->findPage($index);
        return json(['result'=>'success','datas'=>$arrlist,'isMore'=>'True']);
    }


    public function userInfo(Request $request)
    {


        $id = $request->post('id');

        if($id){

           return json_encode((new Member())->getMemberById($id,false,true));
           /* $member =  (new Member())->getMemberById($id,false,true);

            $arr = $member->service->toArray();

            foreach ($arr as $key => $val){

                $arr[$key] = '-'.$val['Id'].'%';
                $arrId[$key] = $val['Id'];

            }

            $obj = new Org();

            $arrGroup = $obj->getOrgByPath($arr);



            foreach ($arrGroup as $val){

                if(in_array($val['service'],$arrId))
                  $arrG[]= make_tree($arrGroup,$val['service'],1);
            }

            return json_encode(['member'=>$member,'group'=>$arrG]);*/
        }


    }

    public function partTeam(Request $request,$id=0) {



        if ($request->isPost()) {
           ;
        }else{

            if($id){

                $arr[0] = '-'.$id.'%';

                $obj = new Org();

                $arrGroup = $obj->getOrgByPath($arr);

                $arrG= make_tree($arrGroup,$id,1);

                View::assign('group',$arrG);

                return  View::fetch();
            }
        }



    }

    public function news(Request $request,$index=0)
    {
        if ($request->isPost()) {
            $arrlist = (new Froum())->findPage($index);
            return json(['result'=>'success','datas'=>$arrlist,'isMore'=>'True']);
        }

       return View::fetch();
    }


    public function editService(Request $request)
    {
        if ( $request->isPost() ) {
            $arr = $request->post();
            $member = new Member();
            $msg = '更新成功';
            foreach ($arr['service'] as $val) {
                try{
                    $member = $member->find($arr['id']);
                    $member->service()->attach($val);
                }catch (\Exception $e){
                   $msg =  $e->getMessage();
                }

            }

            return json(['result'=>'success','msg'=>$msg]);
        }
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

    public function project () {
        return View::fetch();
    }
}
