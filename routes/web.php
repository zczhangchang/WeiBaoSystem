<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//登录
Route::get('/auth/login', 'Admin\AuthController@getLoginPage')->name('admin.auth.login_page');
Route::post('/auth/login', 'Admin\AuthController@postLogin')->name('admin.auth.login1');
Route::get('/auth/logout', 'Admin\AuthController@getLogout')->name('admin.auth.logout');
Route::post('/users/list', 'Admin\AuthController@postListPage')->name('admin.users.list');


//用户界面
Route::get('/user/list', 'Admin\UserController@getListPage')->name('admin.user.list_page');
Route::post('/user/delete', 'Admin\UserController@postDelete')->name('admin.user.delete');
Route::post('/user/deletemore','Admin\UserController@postDeleteMore')->name('admin.user.deletemore');
Route::post('/user/add', 'Admin\UserController@postAdd')->name('admin.user.add');

Route::get('user/update','Admin\UserController@getUpdate')->name('admin.user.update');
Route::post('/user/save', 'Admin\UserController@postSave')->name('admin.user.save');


//用户退出
Route::get('/user/logout', 'Admin\UserController@getLogout')->name('admin.user.logout');
Route::post('/user/logout', 'Admin\UserController@postLogout')->name('admin.user.logout');


//用户的管理
Route::get('/user/app','Admin\UserController@getApp')->name('admin.user.app');
Route::post('/user/auth','Admin\UserController@postAuth')->name('admin.user.auth');



//工单管理
Route::get('/order/list','Admin\OrderController@getOrderPage')->name('admin.order.list');
Route::get('/order/list','Admin\OrderController@getShowOrder')->name('admin.show.order');
Route::get('/order/details','Admin\OrderController@getdetails')->name('admin.order.details');
Route::post('/order/select','Admin\OrderController@postSelect')->name('admin.order.select');
Route::post('/order/list','Admin\OrderController@postStatus')->name('admin.order.status');




Route::post('/order/give', 'Admin\OrderController@postGiveOrder')->name('giveOrder');
Route::post('/order/back', 'Admin\OrderController@postBackOrder')->name('backOrder');
Route::post('/order/submit', 'Admin\OrderController@postSubmitOrder')->name('submitOrder');




//派单管理
Route::get('/dispach/list','Admin\DispachController@getDispach')->name('admin.dispach.list');
Route::get('/dispach/show','Admin\DispachController@getShowDispach')->name('admin.dispach.show.list');
Route::post('/dispach/select','Admin\DispachController@postSelect')->name('admin.dispach.select');


//报修地址设置
Route::get('/address/list','Admin\AddressController@getAddress')->name('admin.address.list');
Route::get('/address/list','Admin\AddressController@getShowAddress')->name('admin.show.address.list');
Route::get('/address/update','Admin\AddressController@getUpdateAddress')->name('admin.address.update');
Route::post('/address/add','Admin\AddressController@postAddAddress')->name('admin.add.list');
Route::post('/address/delete','Admin\AddressController@postDeleteAddress')->name('admin.address.delete');



//我的工单
Route::get('/myOrder/list','Admin\ApplyController@getMyorder')->name('admin.myOrder.list');
Route::get('/myOrder/list','Admin\ApplyController@getShowMyOrder')->name('admin.myOrder.show.list');
Route::post('/myOrder/apply','Admin\ApplyController@postApplyAdd')->name('admin.myOrder.apply.add');
Route::post('/myOrder/back','Admin\ApplyController@postBackOrder')->name('admin.myOrder.back');



//退回工单
Route::get('/backOrder/list','Admin\BackController@getBackOrder')->name('admin.backOrder.list');
Route::get('backOrder/list', 'Admin\BackController@getBackOrderList')->name('admin.backOrder.show.list');
Route::post('/backOrder/list','Admin\BackController@postBackOrder')->name('admin.backOrder.return.list');
Route::post('/backOrder/check', 'Admin\BackController@postCheckOrder')->name('checkOrder');






//维修人员
Route::get('/maintenance/list','Admin\MaintenanceController@getMaintenance')->name('admin.user.Maintenance.list');
Route::get('/maintenance/list', 'Admin\MaintenanceController@getShowMaintenance')->name('admin.user.show.Maintenance');
Route::post('maintenance/delete','Admin\MaintenanceController@postMaintenanceDelete')->name('admin.user.Maintenance.delete');



//任务统计
Route::get('/orderStatistics/list','Admin\OrderStatisticsController@getOrderStatistics')->name('admin.orderStatistics.list');
//Route::get('/orderStatistics/list','Admin\OrderStatisticsController@getSelectNoResult')->name('admin.SelectNoResult.list');




//测试代码
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
