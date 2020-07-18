<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\model\OrgActivity;
use app\BaseController;
use app\mobile\model\Member;
use app\mobile\model\Org;
use app\mobile\model\OrgActivUid;
use think\facade\Session;
use think\Request;
use think\facade\View;
use think\facade\Db;

class Project extends BaseController
{
    //志愿者活动项目列表
    public function index(Request $request)
    {

        $arr = ['privil'=>['like',Session::get('privil').'%']];

        if($request->get('id')==1){
            $arr = 'admin';
        }

        if ($request->get('oid')) {
            $objAdmin = (new Admin())->getByOid((int)$request->get('oid'));
            $id = $objAdmin[0]['Id'];
            $arr = ['group_id'=>['=',$id]];
        }

        $arrlist = (new OrgActivity())->adminPage($arr,20);

        $count = $arrlist->total();
        $page = $arrlist->render();

       // $arrData =  $arrlist->toArray();

        View::assign(['arrlist'=>$arrlist,
                'page'=>$page,
                'count'=>$count,
                'strPri'=>$this->strPri
            ]);



        return  View::fetch();
    }

    /**
     * 添加自愿项目
     */
    public function create()
    {
        View::assign(['list'=>'','service_id'=>Session::get('service'),'privil'=>Session::get('privil')]);

        return View::fetch();
    }


    public function upimg($flag ='')
    {
       $strFlag = 'file';

       if($flag)
           $strFlag = $flag;

       $strUrl = upload_img($strFlag);


       return json([ 'code'=>0,'msg'=>'','data'=>[ 'src'=>'/storage/'.$strUrl]]);
    }

    public function upvideo() {

        $strUrl = upload_img('file','video');

        return json([ 'code'=>0,'msg'=>'','data'=>[ 'src'=>'/storage/'.$strUrl]]);
    }


    public function addArticle(Request $request)
    {

        $data = $request->post();

        $data = $this->handleData($data);

        $data['group_id'] = Session::get('uid');



        $res = (new OrgActivity())->add($data);
        $code = 0;
        if ($res->id){
            $code = 1;
            $ordId = Session::get('ordId');
            if ($ordId)
               (new Org())->incReleaseQuan($ordId,'inc');
        }


        return json(['code'=>$code]);

    }
    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(Request $request,$id=0)
    {

        if ($request->isPost()) {

            $data = $request->post();


            if($request->post('Id')){
                $id = $request->post('Id');//编辑审核状态
                unset($data['Id']);

            }else{
                $data = $this->handleData($data);
            }

            (new OrgActivity())->edit($id,$data);
            return ["code" => 1, "message" => "更新成功"];

            //return ["code" =>0, "message" => $e->getMessage()];

        }else{

            if ($id){
                $info = (new OrgActivity())->whichOne($id);

                View::assign(['info'=>$info,'service_id'=>Session::get('service')]);
                return  View::fetch();
            }

        }

    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function handleData(&$data)
    {

        $dateRec = $data['recruit_time'];
        $dateAct = $data['activity_time'];
        list($time_rec_start,$time_rec_end) = explode(' - ',$dateRec);

        list($time_act_start,$time_act_end) = explode(' - ',$dateAct);
        unset($data['recruit_time']);
        unset($data['activity_time']);

        $data['recruit_time_start'] = strtotime(date($time_rec_start));
        $data['recruit_time_end'] = strtotime(date($time_rec_end));

        $data['activity_time_start'] = strtotime(date($time_act_start));
        $data['activity_time_end'] = strtotime(date($time_act_end));

        //$data['service_id'] = (new Org())->splicingPath($data['service_id']);

        return $data;
    }

    public  function enrollList(){

        $objOrgAct = (new OrgActivity());

        if (Session::get('privil')=='-')
          $list = $objOrgAct->enrollList();
        else
            $list = $objOrgAct->enrollList($id=0,$num=20,'oa.group_id='.Session::get('uid'));


       $count = $list ->total();
       $page = $list->render();

       View::assign(['list'=>$list,
                 'count'=>$count,
                 'page'=>$page
        ]);

       return View::fetch();
    }

    public function scoring($id) {

        $list = (new OrgActivity())->enrollList($id);

        $count = $list ->total();

        $page = $list->render();

        View::assign(['list'=>$list,
            'count'=>$count,
            'page'=>$page
        ]);

        return View::fetch();
    }

    public function LengthSer(Request $request){

        $data = $request->post();

        $integral = $data['length_ser'];

        $data['length_ser'] += $data['old_length_ser'];

        $uid = $data['uid'];

        $Id = $data['Id'];

        unset($data['old_length_ser']);
        unset($data['Id']);
        unset($data['uid']);

        Db::startTrans();
        try{

            $data = (new Member())->editLengthSer($uid,$data);

            if($data){
                $obj =  OrgActivity::field('already_did')->find($Id);
                $obj->already_did .= $uid.',';
                $obj->save();

                (new  OrgActivUid())->updateIntegral($Id,$uid,$integral);
            }

            Db::commit();
           return json(['message'=>'打分成功','code'=>0]);
        } catch (\Exception $e) {
            return  json(['message'=>'打分失败','code'=>1]);
            Db::rollback();
        }


    }
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if ($id) {
            $res = (new OrgActivity())->del($id);
        }

       if ($res) {
           $ordId = Session::get('ordId');
           if ($ordId)
               (new Org())->incReleaseQuan($ordId,'dec');
            return json(['code'=>0,'message'=>'删除成功']);
       }
    }
}
