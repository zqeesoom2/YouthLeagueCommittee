<?php
declare (strict_types = 1);

namespace app\mobile\model;

use think\model\Pivot;

/**
 * @mixin think\Model
 */
class MemberOrg extends Pivot
{

    public function getInfoByMemberId($id){
        return self::where('member_Id',$id)->select()->toArray();
    }

    public function delReturnId($id){

        $obj = self::find($id);

        self::destroy($id);

        return $obj['org_Id'];

    }

    public function updateState($arr,$state) {
        return self::where($arr)->update(['state'=>$state]);
    }

    public function delByUidOid($arr){

        return self::where($arr)->delete();

    }

    public function getMemberState($uid,$oid){
        return self::where(['member_Id'=>$uid,'org_Id'=>$oid])->select()->toArray();
    }

    public function getMemberElse($uid,$type=1){
        return self::where(['member_Id'=>$uid,'state'=>$type])->limit(1)->select()->toArray();
    }
}
