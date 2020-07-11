<?php
declare (strict_types = 1);

namespace app\mobile\model;

use think\Model;

/**
 * @mixin think\Model
 */
class Admin extends Model
{
    public function add($arr) {
        try{
            return self::create($arr);
        }catch(\Exception $e){
            return ['state'=>1,'message'=>$e->getMessage()];
        }
    }

    public function edit($account,$id) {

        return self::where('id',$id)->update(['username'=>$account]);

    }

    public function getByName($name) {

        return self::where('username',$name)->select()->toArray();
    }
}
