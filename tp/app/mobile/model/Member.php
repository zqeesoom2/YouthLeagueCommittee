<?php
declare (strict_types = 1);

namespace app\mobile\model;

use app\admin\model\org;
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

        return (new org())->getServiceByPath($value);


    }

}
