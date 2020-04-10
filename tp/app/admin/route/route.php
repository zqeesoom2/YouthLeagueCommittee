<?php
use think\facade\Route;

//登陆
Route::rule('login','admin/login/index','GET|POST');
//后台首页
Route::get('adminIndex','admin/index/index')->name('adminIndex');
//管理员
Route::rule('adminAdmin','admin/admin/index','GET|POST')->name('adminAdmin');
//管理员角色
Route::rule('adminRole','admin/role/index','GET|POST')->name('adminRole');
//管理员权限
Route::rule('adminPriv','admin/privilege/index','GET|POST')->name('adminPriv');
//团队组织
Route::get('adminAdminOrgs','admin/OrgStruct/index')->name('adminAdminOrgs');
Route::post('orgUpdate','admin/OrgStruct/update')->name('orgUpdate');
