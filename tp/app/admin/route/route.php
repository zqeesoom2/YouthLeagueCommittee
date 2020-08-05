<?php
use think\facade\Route;

//登陆
Route::rule('login','admin/login/index','GET|POST');
//后台首页
Route::get('adminIndex','admin/index/index')->name('adminIndex');


Route::get('Project','admin/project/index')->name('Project');
Route::get('addProject','admin/project/create')->name('addProject');

Route::get('notvolunteer','admin/OrgStruct/examineInfo');

Route::rule('volunteer/[:oid]','admin/index/volunteer','GET|POST')->name('volunteer');
//团队组织
Route::get('adminAdminOrgs','admin/OrgStruct/index')->name('adminAdminOrgs');
Route::get('examineOrg','admin/OrgStruct/examineOrg')->name('examineOrg');

Route::post('orgUpdate','admin/OrgStruct/update')->name('orgUpdate');

Route::get('out','admin/login/out')->name('out');
Route::post('articleUpimage/[:flag]','admin/Project/upimg')->name('articleUpimage');
Route::post('addArticle','admin/Project/addArticle')->name('addArticle');

Route::post('articleUpVideo','admin/Project/upvideo')->name('articleUpVideo');

Route::rule('editOrgAct/[:id]','admin/Project/edit','GET|POST')->name('editOrgAct');
Route::get('enrollList','admin/Project/enrollList')->name('enrollList');

Route::get('scoring/:id','admin/Project/scoring');
Route::post('LengthSer','admin/Project/LengthSer')->name('LengthSer');

Route::post('delOrgAct','admin/Project/delete')->name('delOrgAct');


Route::rule('addFroum','admin/Froum/create','GET|POST')->name('addFroum');
Route::get('froum/[:id]','admin/Froum/index')->name('froum');
Route::rule('editFroum/[:id]','admin/Froum/editFroum','GET|POST')->name('editFroum');
Route::post('delFroum','admin/Froum/delete')->name('delFroum');

Route::rule('user','admin/index/user','GET|POST')->name('adduser');
Route::get('listuser','admin/index/listuser')->name('listuser');

Route::rule('addSlide','admin/Froum/addSlide','GET|POST')->name('addSlide');
Route::get('slideList','admin/Froum/slideList')->name('slideList');
Route::rule('editSlide/[:id]','admin/Froum/editSlide','GET|POST')->name('editSlide');