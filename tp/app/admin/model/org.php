<?php
declare (strict_types = 1);

namespace app\admin\model;

use app\mobile\model\Member;
use app\mobile\model\MemberOrg;
use think\facade\Db;
use think\facade\Session;
use think\Model;

/**
 * @mixin think\Model
 */
class org extends Model
{
    function likeListOrg($strPath) {
        return self::where('path','like',$strPath.'%')->field('Id,org_name,address,status,release_quan,area_id,members,captain,path,service,captain_tell,regist_auth')->select()->toArray();
    }

    function members() {

        return $this->belongsToMany(Member::class,MemberOrg::class,'member_Id','org_Id');
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

    /*function getServiceAttr($val) {

       $obj = self::field('org_name')->find($val);
        if ($obj) {
            return $obj->org_name;
        }

    }*/

    function getServiceByPath($value) {

        if ($value) {
            $arr = self::field('org_name')->find($value);

            return $arr['org_name'];
        }
    }
    function getServiceByPath2($value) {

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
        $arr = self::field('org_name')->where('Id','in',$str)->select()->toArray();

        foreach ($arr as $item) {

            if ($key2==0)
                $str2 .= $item['org_name'] ;
            else
                $str2.='->'.$item['org_name'];
            $key2++;
        }
        return $str2;

    }

    public function getMemberById($id){
        $member=self::find($id);
        $member->members;
        return $member;
    }
}
