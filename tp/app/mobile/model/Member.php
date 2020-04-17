<?php
declare (strict_types = 1);

namespace app\mobile\model;

use app\admin\model\org;
use think\facade\Db;
use think\Model;
use app\mobile\validate\Member as MemberVal;

/**
 * @mixin think\Model
 */
class Member extends Model
{
    function add ($data){
        $validate =new MemberVal();
        $res = (new MemberVal())->check($data);
        if (!$res) {
            $error = $validate ->getError();
            return ['state'=>1,'error'=>$error];
        }

        try{
            self::create($data);
            return ['state'=>0,'status'=>'审核中'];
        }catch(\Exception $e){
            return ['state'=>1,'message'=>$e->getMessage()];
        }


    }

    function memberList() {

        return Member::select()->toArray();

    }

    function memberByName($name) {

         $obj = Member::where('username',$name)->find();
        if ($obj) {
            return $obj->toArray();
        }
        return null;

    }

    public  function getStatusAttr($value){
        if ($value==0) {
            return "待审核";
        }else{
            return "志愿者会员";
        }

    }

    public function list($pri){
        return self::where('group','like',$pri.'%')->select()->toArray();
    }

    public function getGroupAttr($value) {

        $arr = array_filter(explode('-',$value));
        $str = $str2 ='';
        $key = $key2 = 0;
        foreach ($arr as  $id) {
            if($key==0)
                $str.=$id;
            else
                $str.=','.$id;
            $key++;
        }
        $arr = Db::name('org')->field('org_name')->where('Id','in',$str)->select()->toArray();
        foreach ($arr as $item) {

            if ($key2==0)
              $str2 .= $item['org_name'] ;
            else
                $str2.='->'.$item['org_name'];
            $key2++;
        }
        return $str2;

    }

}
