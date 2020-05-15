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
    function add ($data,$arrGid = null){
        $validate =new MemberVal();
        $res = $validate->check($data);
        if (!$res) {
            $error = $validate ->getError();
            return ['state'=>1,'error'=>$error];
        }

        try{
           // $member = self::create($data);
            //halt(self::find($member['Id']));

           // self::find($member->id)->service()->saveAll($arrGid);

            //halt(MemberOrg::class);
            self::create($data)->service()->saveAll($arrGid);

            return ['state'=>0,'status'=>'审核中'];
        }catch(\Exception $e){
            return ['state'=>1,'message'=>$e->getMessage()];
        }


    }

    function service() {

        return $this->belongsToMany(org::class,MemberOrg::class,'org_Id','member_Id');
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

    public  function editLengthSer($Id,$data) {

        return self::where('Id',$Id)->update($data);
    }

    public function getMemberById($id,$field = null,$get_serivce=false){

        if ($field) {
            $member =  self::field($field)->find($id);
        }

        if($get_serivce){
            $member =self::find($id);
            $member->service;
        }

        return $member;
    }


}
