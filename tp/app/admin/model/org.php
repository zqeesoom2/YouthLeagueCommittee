<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\facade\Db;
use think\facade\Session;
use think\Model;

/**
 * @mixin think\Model
 */
class org extends Model
{
    function likeListOrg($strPath) {
        return self::where('path','like',$strPath.'%')->select()->toArray();
    }

    function getRegistAuthAttr($value){
        if ($value==1)
            return '对外开放';
        else
            return '对内开放';
    }

    function getStatusAttr($value){
        if ((int)($value))
            return '审核通过';
        else
            return '审核中';
    }

    public function editorg($arr)
    {
        try{
            self::where('Id',array_shift($arr))->update($arr);
            return ["code" => 1, "message" => "更新成功"];
        }catch(\Exception $e){
            return ["code" =>0, "message" => $e->getMessage()];
        }

    }

    function getAreaIdAttr($val) {

        return (Db::name('area')->find($val))['area'];

    }

    function getServiceAttr($val) {

       $obj = self::field('org_name')->find($val);
        if ($obj) {
            return $obj->org_name;
        }


    }
}
