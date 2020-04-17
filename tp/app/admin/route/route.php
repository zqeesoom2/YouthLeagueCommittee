<?php
use think\facade\Route;

//登陆
Route::rule('login','admin/login/index','GET|POST');
//后台首页
Route::get('adminIndex','admin/index/index')->name('adminIndex');


Route::get('Project','admin/project/index')->name('Project');
Route::get('addProject','admin/project/create')->name('addProject');


Route::rule('volunteer','admin/index/volunteer','GET|POST')->name('volunteer');
//团队组织
Route::get('adminAdminOrgs','admin/OrgStruct/index')->name('adminAdminOrgs');
Route::post('orgUpdate','admin/OrgStruct/update')->name('orgUpdate');

Route::get('out','admin/login/out')->name('out');
