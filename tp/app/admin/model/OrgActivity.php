<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Model;

/**
 * @mixin think\Model
 */
class OrgActivity extends Model
{
   public function add($data) {

    return self::create($data);

   }
}
