<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;

/**
 * @mixin think\Model
 */
class Admin extends Model
{
    use SoftDelete;
    protected $deleteTime= 'delete_time';

    public function add($data) {

        return self::create($data);

    }
    public function adminPage($where,$num) {
        $arrWhere = [];
        foreach ($where as $key =>$val) {
            array_push($arrWhere,[$key,$val[0],$val[1]]);
        }

        return self::field('Id,create_time,title,summary,group_id')->where([
            $arrWhere
        ])->order('id', 'desc')->paginate($num);
    }

    public  function edit($id,$data) {
        self::where('Id',$id)->update($data);
    }


    public function del($id) {
        return self::find($id)->delete();
    }

    public function getOne($id){

        return self::find($id);
    }

    public function getByOid($id) {

       return self::where('org_id',$id)->select()->toArray();
    }
}
