<?php
declare (strict_types = 1);

namespace app\mobile\controller;

use app\admin\model\Froum;
use app\admin\model\OrgActivity;
use app\mobile\model\Member;
use app\mobile\model\Admin;
use app\mobile\model\MemberOrg;
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

    function search($key){

        $arr = (new OrgActivity())->whereLike($key);
        View::assign('list',$arr);

       return View::fetch();
    }
    /**
     *
     *
     *创建团队
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

                if($arrCreate['service'])
                    $arrCreate['path'] = '-'.$arrCreate['service'];

                for($i=1;$i<4;$i++){
                    $key = "service$i";
                    if ($arrCreate[$key]) {
                        $arrCreate['path'] .= '-'.$arrCreate[$key];
                        $arrCreate['service'] = $arrCreate[$key];
                    }

                }

                $password = md5($arrCreate['password'].Config::get('cus.salt'));
                $username = $arrCreate['org_name'];
                unset($arrCreate['password']);

                $arr = $obj->add($arrCreate);


                (new Admin())->add(['username'=>$username,'password'=>$password,'privil'=>$arrCreate['path'],'org_id'=>$arr['data']['org_id']]);


                Db::commit();

                return  json($arr);
            }

            return json( ['state'=>1,'message'=>'团队名已存在']);

       } catch (\Exception $e) {
            Db::rollback();
            return json( ['state'=>1,'message'=>$e->getMessage()]);
        }
    }

    //报名
    public function enroll(Request $request) {

        $id = (int) $request->get('id');
        $uid = (int) $request->get('uid');
        $group =  $request->get('group');
        $service = $request->get('service');
        $f = true;
        $f2 = true;

        $arrS = (new Member())->getMemberById($uid,'',true);

        if ($arrS->status=='待审核'){

            return json(['code'=>1,'data'=>'账号待审核不能报名']);
        }

        if ( $id && $uid ) {

            $ObjOrgActivity = new OrgActivity();
            $resOrgAct = $ObjOrgActivity->whichOne($id);

            if ($resOrgAct->regist_auth=='对内开放'){

                $oid = (new Org())->orgByName($group)['id'];

                //$oid = (new Admin())->getByName($group)[0]['Id'];

                $resArr = (new MemberOrg())->getMemberState($uid,$oid);



                if (empty($resArr)){
                    return json(['code'=>1,'data'=>'你还没有参加组织，不能报名']);
                }

                if (!$resArr[0]['state']){
                    return json(['code'=>1,'data'=>'账号在组织中待审核不能报名']);
                }

                foreach ($arrS->service->toArray() as $val) {
                    if ( $val['org_name']==$service  ) {
                        $f = false;
                    }
                    if ( $val['org_name']== $group ) {
                        $f2 = false;
                    }

                }

                if($f)
                    return json(['code'=>1,'data'=>'账号隶属服务类型不匹配']);

                if($f2)
                    return json(['code'=>1,'data'=>'账号隶属组织类型不匹配']);

            }else{

                $resArr = (new MemberOrg())->getMemberElse($uid);

                if (empty($resArr)){
                    return json(['code'=>1,'data'=>'你还没有任何参加组织，不能报名']);
                }
            }

           /* if ($arrS->group!=$group){
                return json(['code'=>1,'data'=>'账号服务类型错误']);
            }*/

            $msg = '已报名';
            $obj = new OrgActivUid();
            $arr = $obj->findOne($id,$uid);

            if (empty($arr)) {

               $objD = $obj->add(['org_act_id'=>$id,'uid'=>$uid]);

               if ($objD){
                   $res = $ObjOrgActivity->incEnroll($id);
                   $msg = '报名成功';

                   if(!$res){
                       $msg = '报名失败';
                       $obj->delEnroll(['org_act_id'=>$id,'uid'=>$uid]);
                   }

               }else{
                   $msg = '报名失败';
               }

            }
            return json(['code'=>1,'data'=>$msg]);
        }


    }

    //内容页面
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
     *
     *
     *
     */
    public function read($index)
    {

        $arrlist = (new OrgActivity())->findPage($index);
        return json(['result'=>'success','datas'=>$arrlist,'isMore'=>'True']);
    }

    //获取用户信息
    public function userInfo(Request $request)
    {

        $id = $request->post('id');

        if($id){

           $objMember = new Member();

           $alreadyProNum = (new OrgActivity())->alreadyPro($id);

           $member = Member::find($id);

           $PartingNum = $member->userParting()->where('integral',0)->count();

           return json_encode(['user'=> $objMember->getMemberById($id,false,true),'alreadyProNum'=>$alreadyProNum,'PartingNum'=>$PartingNum]);
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

    //团队管理
    public function partTeam(Request $request,$id=0,$exitTeam=0,$uId=0) {

        if ($request->isPost()) {

            $arr = $request->post();

            $member = new Member();
            $org = new Org();
            $mo = new MemberOrg();

            $msg = '更新成功';

            if (isset($arr['service']['plus']) )
                foreach ($arr['service']['plus'] as $val) {
                    try{

                        $member = $member->find($arr['id']);

                        $member->service()->attach($val);

                        //$org->incMembers($val,'inc');

                    }catch (\Exception $e){
                        $msg =  $e->getMessage();
                    }
                }

            if (isset($arr['service']['reduce']) )
                foreach ( $arr['service']['reduce'] as $val) {

                    try{
                        $org->incMembers($mo->delReturnId($val),'dec');

                    }catch (\Exception $e){
                        $msg .=  $e->getMessage();
                    }

                }

            return json(['result'=>'success','msg'=>$msg]);

        }else{//退出团队

            if($id)

                $arr[0] = '-'.$id.'%';

                $obj = new Org();

                $arrGroup = $obj->getOrgByPath($arr);

                $arrG= make_tree($arrGroup,$id,1);

                $arrUser = session::get('userInfo');

                if ($arrUser || $uId) {

                   if (!$uId)
                       $arrOid = (new MemberOrg())->getInfoByMemberId($arrUser['uId']);
                   else
                       $arrOid = (new MemberOrg())->getInfoByMemberId($uId);

                   View::assign(['group'=>$arrG,'arrOid'=>$arrOid,'serviceId'=>$id,'exitTeam'=>$exitTeam,'f'=>null]);

                   return  View::fetch();
                }else{
                    return redirect((string)url('moblielogin'));
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

    //服务类型
    public function serviceType(){

        return View::fetch('service');
    }

    //服务介绍
    public function serviceInfo(){

        return View::fetch();
    }

    //用户加入8个服务其中之4
    public function editService(Request $request)
    {
        if ( $request->isPost() ) {
            $arr = $request->post();
            $member = new Member();
            $msg = '更新成功';
            foreach ($arr['service'] as $val) {
                try{
                    $member = $member->find($arr['id']);
                    // 增加关联的中间表数据
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

    public function getOrg($service_id) {
       if ((int)$service_id) {
          return json_encode((new Org())->orgByService($service_id)->toArray());
       }
    }

    //已参加的项目
    public function userIntegral($uId,$flag=1) {

        $list = $page = $count = [];

        $whereTime = ['activity_time_end','<=',time()];

        if(!$flag)
            $whereTime = ['recruit_time_end','>=',time()];

        if ($uId) {
            $list = (new OrgActivity())->enrollList(0,20,$where = 'm.id='.$uId,'oa.Id,oau.integral',$whereTime);
            $count = $list ->total();
            $page = $list->render();
        }

        View::assign(['list'=>$list,
            'count'=>$count,
            'page'=>$page,
            'flag'=>$flag
        ]);

        return View::fetch();
    }
}
