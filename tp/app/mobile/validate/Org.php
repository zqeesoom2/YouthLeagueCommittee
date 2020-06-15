<?php
declare (strict_types = 1);

namespace app\mobile\validate;

use think\Validate;

class Org extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = ['org_name'=>['require'],

        'area_id'=>['require'],
        'address'=>['require'],
        'captain'=>['require'],
        'captain_tell'=>['require'],
        'service'=>['require']
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = ['org_name.require' =>'团体名称不能为空',

        'area_id.require' =>'区域名不能为空',
        'address.require' =>'地址不能为空',
        'captain.require' =>'队长不能为空',
        'captain_tell.require' =>'队长电话不能为空',
        'service'=>'服务类型不能为空'

    ];
}
