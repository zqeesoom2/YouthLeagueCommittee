<?php
// 应用公共文件

function make_tree($data,$parent_id = 0,$level = 1)
{
    static $newData = [];

    foreach ($data as $k => $d) {

        if ($d["service"] == $parent_id ) {

            $d["level"] = $level;
            $newData[] = $d;
            make_tree($data,$d["id"],$level+1);
        }
    }

    return $newData;
}


function upload_img($field , $catalog = 'images'){

    $file = request()->file($field);
   if ($file){
       try {
           validate(['file' => [
               'fileSize' => 8388608, 'fileExt' => 'gif,jpg,png,mp4']])->check(['file'=>$file]);

           $savename= \think\facade\Filesystem::disk('public')->putFile($catalog, $file);

           return $savename;
       } catch (\think\exception\ValidateException $e) {
           return  $e->getMessage();
       }
   }

   return 0;

}

function projectStatus ($status,$recruit_time_start,$recruit_time_end,$activity_time_start,$activity_time_end) {

    switch ($status){
        case 4 : $v = '审核不通过';break;
        case 6 :
            $v =  timeStatus($recruit_time_start,$recruit_time_end,$activity_time_start,$activity_time_end);
            break;
        default: $v = '审核中';
    }
    return $v;
}

function timeStatus($recruit_time_start,$recruit_time_end,$activity_time_start,$activity_time_end){

    $time = time();

    if(strstr($recruit_time_start,'-'))
        $recruit_time_start =  strtotime(date($recruit_time_start));
    if(strstr($recruit_time_end,'-'))
        $recruit_time_end =  strtotime(date($recruit_time_end));
    if(strstr($activity_time_start,'-'))
        $activity_time_start = strtotime(date($activity_time_start));
    if(strstr($activity_time_end,'-'))
        $activity_time_end = strtotime(date($activity_time_end));

    if ($recruit_time_end > $time) {
        return '招募中';
    }else if ($activity_time_start > $time && $activity_time_end > $time) {
        return '进行中';
    }else{
        return '已结束';
    }


}
//删除空数组
function filter_pri($value) {
   return array_filter(explode('-',$value));
}

//根据年月获取季度
function getQuarterByMonth($date){

    $year = (int) substr($date,0,4);

    $month = (int) substr($date,-2);

    if($month<=3){
        $year -= 1;
        $month =  12-$month;

    }else{
        $month -=  3;
    }
    return $year.$month;
}
