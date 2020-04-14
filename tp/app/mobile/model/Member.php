<?php
declare (strict_types = 1);

namespace app\mobile\model;

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

        return Member::where('username',$name)->find()->toArray();

    }

    public  function getStatusAttr($value){
        if ($value==0) {
            return "待审核";
        }else{
            return "志愿者会员";
        }

    }

}
