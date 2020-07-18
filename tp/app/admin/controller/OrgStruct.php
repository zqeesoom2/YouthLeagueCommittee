<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\mobile\model\MemberOrg;
use think\facade\Session;
use app\BaseController;
use think\Request;
use think\facade\View;
use app\admin\model\org;

class OrgStruct extends BaseController
{
    /**
     *
     *
     * 团队组织结构
     */
    public function index()
    {
        $n = Session::get('service') ? Session::get('service') : 0 ;

        $arrOrg = make_tree((new org())->likeListOrg(Session::get('privil')),$n);

        View::assign('arrOrg',$arrOrg);
        View::assign('privil',Session::get('privil'));

        return View::fetch();
    }

    /**
     *
     *
     *
     */
    public function members()
    {
        $list = (new org())->enrollList();
        $count = $list ->total();
        $page = $list->render();
        View::assign(['list'=>$list,
            'count'=>$count,
            'page'=>$page
        ]);
        return View::fetch();
    }



    /**
     * 保存更新的资源
     *
     *
     */
    public function update(Request $request)
    {
        //$strAccount = $request->post('org_name');

        return  json((new org())->editorg($request->post()));
    }

    //查看团队审核明细
    public function examineInfo(Request $request) {

        $list = (new org())->getALLNot($this->strPri)->toArray();
        $list2 = [];
        foreach ($list as $item) {
            if ($item['users_count']){
                array_push($list2,$item);
            }
        }

        View::assign([
            'privil' => $this->strPri,
            'arrOrg'=>$list2

        ]);

        return View::fetch();
    }

    //查看审核人员
    public function notVolunteer(Request $request) {

        $id = $request->param('oid');
        $orgName = $request->param('name');


       $list = (new org())->getMemberById($id,0)->toArray();


        View::assign([
            'privil' => $this->strPri,
            'arrVolunteer'=>$list,
            'count'=> count($list),
            'nopage'=>1,
            'orgName'=>$orgName,
            'oid'=>$id
        ]);

        return View::fetch('notVolunteer');
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
        $MemberOrgObj = new MemberOrg();

        $org = new \app\mobile\model\Org();
        $orgObj = (new org())->getOrgById($post['oid']);

        if (!$orgObj->service){
            if ( $MemberOrgObj->updateState(['member_Id'=>$post['id'],'org_Id'=>$post['oid']],$post['status']) ){

                $org->incMembers($post['oid'],'inc');
                $msg = '提交成功';
                $code = 0;
            }
        }else{

           $arr = array_filter(explode('-',$orgObj->path));

           $service = array_shift($arr);

           $resArr = (new MemberOrg())->getMemberState($post['id'],$service); //判断有没有被最上层服务审核


            if(!($resArr[0]['state'])){
                $msg = '提交失败,参加的服务类型还没有通过';
                $code = 1;
            }else{
                if ( $MemberOrgObj->updateState(['member_Id'=>$post['id'],'org_Id'=>$post['oid']],$post['status']) ){
                    $org->incMembers($post['oid'],'inc');
                    $msg = '提交成功';
                    $code = 0;
                }
            }

        }




        return  json(['code'=>$code,'message'=>$msg]);
    }

    //删除会员
    public function delMemberOrg(Request $request){

        $post = $request->post();
        $msg = '提交失败,该会员不属于你的团队';
        $code = 1;

        if ( (new MemberOrg())->delByUidOid(['member_Id'=>$post['uid'],'org_Id'=>$post['oid']]) ){
            $msg = '提交成功';
            $code = 0;
        }

        return  json(['code'=>$code,'message'=>$msg]);
    }

    public function examineOrg() {

        $arrOrg = (new org())->likeListOrg2(Session::get('privil'));

        View::assign('arrOrg',$arrOrg);
        View::assign('privil', $this->strPri);

        return View::fetch();

    }
}
