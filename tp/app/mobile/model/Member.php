<?php
declare (strict_types = 1);

namespace app\mobile\model;

use app\admin\model\org;
use think\Model;
use app\mobile\validate\Member as MemberVal;
use think\model\Relation;

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
            $Objmember =  self::create($data);
            $Objmember->service()->saveAll($arrGid);

            return ['state'=>0,'status'=>'审核中','uId'=>$Objmember->id];
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

        if ($pri=='-') {
            return self::where('group','like',$pri.'%')->order('id', 'desc')->paginate(20);
        }else{

            $arr = filter_pri($pri);

            return self::Db('member')->alias("m")
                ->field('m.id,m.real_name,m.phone,m.address,m.email,m.nation,m.brith,m.gender,m.political_affil,m.card_type,m.card,m.education,m.pract,m.length_ser,m.status')
                ->join('member_org mo','m.id=mo.member_Id')
                ->where('mo.org_Id','in',$arr)->group('m.id')
                ->order('id', 'desc')->paginate(20);
        }




    }

    public function getGroupAttr($value) {

        return (new org())->getServiceByPath($value);

    }

    public  function editLengthSer($Id,$data) {

        return self::where('id',$Id)->update($data);
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

    public function userParting(){

        return $this->hasMany(OrgActivUid::class,'uid','id');
    }

    public function statistics($type=1){

        $Obj = self::field('username,length_ser');

        if ($type==2){//年度
              $Obj = $Obj->whereYear('create_time');

        }elseif($type==3){//季度
            $endTime=  date('Ym');
            $quarter = getQuarterByMonth($endTime);
            $Obj = $Obj->whereNotBetweenTime('create_time', $quarter, $endTime);
        }

        return $Obj->order('length_ser','DESC')->limit(10)->select();
    }
}
