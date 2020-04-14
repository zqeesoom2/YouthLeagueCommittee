<?php
declare (strict_types = 1);

namespace app\mobile\validate;

use think\Validate;

class Member extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'username'=>['require'],
        'password'=>['require'],
        'real_name'=>['require'],
        'phone'=>['require'],
        'address'=>['require'],
        'gender'=>['require'],
        'political_affil'=>['require'],
        'group'=>['require'],
        'area'=>['require'],
        'email'=>['require'],
        'nation'=>['require'],
        'brith'=>['require'],
        'card'=>['require'],
        'card_type'=>['require'],
        'education'=>['require'],
        'pract'=>['require']
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'username.require' =>'用户名不能为空',
        'password.require' =>'密码不能为空',
        'real_name.require' =>'真实姓名不能为空',
        'phone.require' =>'电话不能为空',
        'address.require' =>'地址不能为空',
        'gender.require' =>'性别不能为空',
        'political_affil.require' =>'政治面貌不能为空',
        'group.require' =>'团体服务类型不能为空',
        'area.require' =>'地区不能为空',
        'email.require' =>'email不能为空',
        'nation.require' =>'民族不能为空',
        'brith.require' =>'出生年月不能为空',
        'card.require' =>'证件号不能为空',
        'card_type.require' =>'证件类型不能为空',
        'education.require' =>'最高学历不能为空',
        'pract.require' =>'从业状况不能为空'
    ];

}
