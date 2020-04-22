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

            if ($item->group_id) {
                $arrAdmin = Db::name('admin')->find($item->group_id);
                $item->group_id = $arrAdmin['username'];
                if ($item->group_id=='admin') {
                    $item->group_id = '州团委';
                }
            }

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

           if ($item->service_id) {
               $item->service_id = (new org())->getServiceByPath($item->service_id);
           }

        });
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
}
