<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

//登录 
Route::rule('userLogin','api/UserController/login')->allowCrossDomain();

//获取所有的项目
Route::rule('item/myitem','api/ItemController/myitem')->allowCrossDomain();
Route::rule('item/adminItem','api/ItemController/adminItem')->allowCrossDomain();
Route::rule('item/itemMenu','api/ItemController/itemMenu')->allowCrossDomain();
Route::rule('item/getItemDtl','api/ItemController/getItemDtl')->allowCrossDomain();
Route::rule('item/updateItem','api/ItemController/updateItem')->allowCrossDomain();
Route::rule('item/addItem','api/ItemController/addItem')->allowCrossDomain();
Route::rule('item/deleteItem','api/ItemController/deleteItem')->allowCrossDomain();
//查询页面内容

Route::rule('page/getPageCont','api/PageController/getPageCont')->allowCrossDomain();
Route::rule('page/getDefaultCat','api/PageController/getDefaultCat')->allowCrossDomain();
Route::rule('page/pageSave','api/PageController/pageSave')->allowCrossDomain();
//人员 ->allowCrossDomain()

Route::rule('user/getUserList','api/UserController/getUserList')->allowCrossDomain(); 
Route::rule('user/deleteUser','api/UserController/deleteUser')->allowCrossDomain(); 
Route::rule('user/userUpdatePassword','api/UserController/userUpdatePassword')->allowCrossDomain();
Route::rule('user/addUser','api/UserController/addUser')->allowCrossDomain();

Route::rule('temp/getList','api/TempController/getList')->allowCrossDomain();
Route::rule('temp/tempSave','api/TempController/tempSave')->allowCrossDomain();
Route::rule('temp/tempDelete','api/TempController/tempDelete')->allowCrossDomain();

//章节
Route::rule('cat/getItemCatList','api/CatController/getItemCatList')->allowCrossDomain();
Route::rule('cat/saveCat','api/CatController/saveCat')->allowCrossDomain();
Route::rule('cat/updateCat','api/CatController/updateCat')->allowCrossDomain();
Route::rule('cat/catDelete','api/CatController/catDelete')->allowCrossDomain();
return [

];
