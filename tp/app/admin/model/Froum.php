<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;

/**
 * @mixin think\Model
 */
class Froum extends Model
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

        return self::field('Id,create_time,title,summary,group_id,status')->where([
            $arrWhere
        ])->order('id', 'desc')->paginate($num);
    }

    public  function edit($id,$data) {
        self::where('Id',$id)->update($data);
    }

    function  getGroupIdAttr($value) {
        $arrAdmin = Db::name('admin')->find($value);
        $value = $arrAdmin['username'];
        if ($value=='admin') {
            $value = '团州委';
        }
        return $value;
    }

    public function del($id) {
        return self::find($id)->delete();
    }

    public function getOne($id){
        return self::find($id);
    }

    public function findPage ( $index ) {
        return self::where('status',1)->page((int)$index,20)->order('id', 'desc')->select()->toArray();
    }

    public function noAuditStatistics($arrWhere) {

       return self::where($arrWhere)->count();
    }
}
