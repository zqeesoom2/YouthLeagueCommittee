<?php
use think\facade\Route;
Route::post('regmember','mobile/reg/create');
Route::get('moblielogin','mobile/Index/login')->name('moblielogin');
Route::get('me','mobile/Index/index');
Route::post('regorg','mobile/index/create');
Route::post('getorg','mobile/index/getOrg');
Route::post('readAct/:index','mobile/Index/read');
Route::post('readNews/:index','mobile/Index/news');
