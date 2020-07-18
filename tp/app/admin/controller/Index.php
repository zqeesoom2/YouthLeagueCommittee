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
     *
     *
     * 系统信息，审核统计
     */
    public function index(Request $request)
    {

        $objFroum =  new Froum();
        $objOrgActivity = new OrgActivity();
        $objOrg = new org();


        $uid = Session::get('uid');
        $notOrg = 0;

        if ($uid==1) {
            $arrWhere['status'] = 0;
            $arrWhere2 = '';

        }else {

            $arrWhere['status'] = 1;
            $arrWhere['group_id'] = $uid;

            $arrWhere2[0] = ['status','=',6];
            $arrWhere2[1] = ['privil','like',$this->strPri.'%'];
         }

        // 待审核会员
       $list =  $objOrg->getALLNot($this->strPri)->toArray();

        $num = 0;

        foreach ($list as $value) {
            $num+=$value['users_count'];
        }


        $notOrg = $objOrg->getNotOrgNum($this->strPri);

        View::assign([
            "noAuditNews" => $objFroum->noAuditStatistics($arrWhere),
            'noAuditActiv' => $objOrgActivity->noAuditStatistics($arrWhere2),
            'privil' => $this->strPri,
            'notExamine'=>$num,
            'notOrg'=>$notOrg
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
     * 团队成员
     *
     *
     */
    public function volunteer(Request $request, $oid=0)
    {


        if ($oid){
            $objOrg = new org();

            $arr = $objOrg->getMemberById($oid)->toArray();

            View::assign([
                'privil' => $this->strPri,
                'arrVolunteer'=>$arr,
                'count'=> count($arr),
                'nopage'=>1,
                'orgId'=>Session::get('ordId')
            ]);
            return View::fetch();

        }else{
           $oid =  Session::get('ordId');

            $arr = $arrIn = ['1','2','3','4','5','6','7'];
            if ($this->strPri != '-'){
                $arr = filter_pri($this->strPri);
                array_push($arr,$oid);
                /*foreach ($arr as &$item) {
                        if (in_array($item,$arrIn)){
                            $item =$oid;
                        }
                }*/
            }

            $count = 0;

            $objMember = new Member();

            $arrVolunteer =  $objMember->list($arr);



            if ($arrVolunteer)
                $count = $arrVolunteer->total();

            View::assign([
                'privil' => $this->strPri,
                'arrVolunteer'=>$arrVolunteer,
                'count'=>$count,
                'nopage'=>0,
                'orgId'=>$oid
            ]);
            return View::fetch();
        }

    }


    /**
     *
     *
     * 会员通过审核，
     *
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




}
