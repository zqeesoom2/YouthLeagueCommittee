<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\facade\Db;
use think\Model;
use app\admin\model\org;

/**
 * @mixin think\Model
 */
class OrgActivity extends Model
{
   public function add($data) {

    return self::create($data);

   }

    public function page($where,$num) {
       return self::field('Id,status,group_id,title,area,recruit_time_start,recruit_time_end,activity_time_start,activity_time_end,recruit_num,service_id')->where('service_id','like',$where.'%')->order('id', 'desc')->paginate($num)->each(function($item, $key){

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
                    $item->status =  $this->timeStatus($item->recruit_time_start,$item->recruit_time_end,$item->activity_time_start,$item->activity_time_end);
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

    public function timeStatus($recruit_time_start,$recruit_time_end,$activity_time_start,$activity_time_end){

       $time = time();

       if ($recruit_time_end > $time) {
         return '招募中';
       }else if ($activity_time_start < $time ) {
            return '进行中';
       }else{
           return '已结束';
       }

    }

    public  function edit($id,$data) {

       self::where('Id',$id)->update($data);

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


    public function whichOne($id){
       return self::find($id);
    }
}
