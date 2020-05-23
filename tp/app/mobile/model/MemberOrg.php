<?php
declare (strict_types = 1);

namespace app\mobile\model;

use think\Model\Pivot;

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


}
