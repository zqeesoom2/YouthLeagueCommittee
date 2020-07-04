<?php
declare (strict_types = 1);

namespace app\mobile\model;


use think\Model;

/**
 * @mixin think\Model
 */
class OrgActivUid extends Model
{
    public function findOne($id,$uid) {

       return self::where(['org_act_id'=>$id,'uid'=>$uid])->select()->toArray();
    }

    public function add($data) {

        return self::create($data);
    }

    public function delEnroll($dada){
        return self::where($dada)->delete();
    }

    public function updateIntegral($org_act_id,$uid,$integral){
        return self::update(['integral'=>$integral],['org_act_id'=>$org_act_id,'uid'=>$uid]);
    }

}
