<?php
declare (strict_types = 1);

namespace app\admin\model;

use app\admin\model\org;
use think\facade\Db;
use think\Model;


/**
 * @mixin think\Model
 */
class OrgActivity extends Model
{
   public function add($data) {

    return self::create($data);

   }

    public function adminPage($where,$num) {
       $arrWhere = [];
       foreach ($where as $key =>$val) {
           array_push($arrWhere,[$key,$val[0],$val[1]]);
       }

       return self::field('Id,regist_auth,status,group_id,title,area,recruit_time_start,recruit_time_end,activity_time_start,activity_time_end,recruit_num,service_id')->where([
           $arrWhere
       ])->order('id', 'desc')->paginate($num)->each(function($item, $key){

            /*if ($item->group_id) {
                $arrAdmin = Db::name('admin')->find($item->group_id);
                $item->group_id = $arrAdmin['username'];
                if ($item->group_id=='admin') {
                    $item->group_id = '州团委';
                }
            }*/

            switch ($item->status){
                case 4 : $item->status = '审核不通过';break;
                case 6 :
                    $item->status =  timeStatus($item->recruit_time_start,$item->recruit_time_end,$item->activity_time_start,$item->activity_time_end);
                    break;
                default: $item->status = '审核中';
            }

            if ($item->area) {
                $item->area =  (Db::name('area')->find($item->area))['area'];
            }

        });
    }

    function  getGroupIdAttr($value) {
        $arrAdmin = Db::name('admin')->find($value);
        $value = $arrAdmin['username'];
        if ($value=='admin') {
            $value = '州团委';
        }
        return $value;
    }

   function getServiceIdAttr ($value) {
      return (new org())->getServiceByPath($value);
   }

    public  function edit($id,$data) {

       self::where('Id',$id)->update($data);

    }


    function getRegistAuthAttr($value){

        if ($value ==1)
            return '对外开放';
        else
            return '对内开放';
    }

    public function getRecruitTimeStartAttr($value){
       return  date('Y-m-d',$value);
    }
    public function getRecruitTimeEndAttr($value){
        return date('Y-m-d',$value);
    }

    public function getActivityTimeStartAttr($value){
        return  date('Y-m-d H:i',$value);
    }
    public function getActivityTimeEndAttr($value){
        return date('Y-m-d H:i',$value);
    }


    public function whichOne($id,$action = 0 ){
       if ($action) {
           return self::find($id)->withAttr('service_id', function($value, $data) {
               return (new org())->getServiceByPath($value);
           });
       }
        return self::find($id);
    }

    public function findPage ( $index ) {

        return self::where('status',6)->withAttr('service_id', function($value, $data) {
            return (new org())->getServiceByPath($value);
        })->page((int)$index,20)->order('id', 'desc')->select()->toArray();
    }

    public function incEnroll($id){
       return self::where('Id',$id)->inc('enroll_num')->update();
    }


    function enrollList ($id=0,$num=20) {

       $where = $g = '';
        $strGc = 'oa.enroll_num,oa.status,oa.Id,oa.recruit_time_start,oa.recruit_time_end,oa.activity_time_start,oa.activity_time_end,group_concat(m.real_name,",") as username ';

        if($id){
            $where = 'oa.Id='.$id;
            $g = 'oa.Id';
            $strGc = 'oa.Id,m.Id as uid ,m.real_name,m.length_ser,m.phone,oa.already_did';
        }
        $obj = self::Db('org_activity')->alias("oa")
            ->field('oa.title,oa.service_id,oa.group_id,'.$strGc)
            ->join('org_activ_uid oau','oa.Id=oau.org_act_id')
            ->join('member m','oau.uid =m.Id')
            ->where($where);

        if(!$id){
            $obj = $obj->group('oa.Id');
        }

        return $obj->withAttr('oa.service_id',function($value,$data){
            return (new org())->getServiceByPath($value);
        })->order('oa.Id', 'desc')->paginate($num);


    }



}
