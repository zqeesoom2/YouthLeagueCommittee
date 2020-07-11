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

    public function index(Request $request)
    {

        return View::fetch();
    }

    //用户加入服务组织
    public function create(Request $request)
    {
        $arrCreate = $request->post();

        $arrCreate['username'] = Session::get('userInfo')['username'];
        $arrGroupId= json_decode($arrCreate['group']);

        $objM = new Member();
       // $objO = new Org();

        if (empty($objM->memberByName($arrCreate['username']))) {
           // $arrCreate['group'] = $objO->splicingPath($arrCreate['group']);
            $arrCreate['group'] = '-';
            $arr = $objM->add($arrCreate,$arrGroupId);

            $Suser = Session::get('userInfo');

            $Suser['uId'] =  $arr['uId'];

            Session::set('userInfo',$Suser);

            return  json($arr);
        }

        return json( ['state'=>1,'message'=>'已激活']);

    }

    //用户排行榜
    public function ranking(Request $request){

        if ($request->isPost()){

            $type =  $request->post('type_');

            $list = (new Member())->statistics($type);

            if ($list)
                $state = 1;
            else
                $state = 0;

            return json(['msg'=>$state,'list'=>$list]);
        }else{

            $list = (new Member())->statistics();

            View::assign('list',$list);

            return View::fetch();

        }


    }


}
