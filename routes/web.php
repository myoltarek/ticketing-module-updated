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

// Route::get('/crm/get-district', 'CrmController@getDistrict');
Route::get('/crm/create', 'CrmController@create');
Route::post('/crm/store', 'CrmController@store')->name('crm.store');

// Route::get('/email', function(){
//     return new App\Mail\NewTicketMail();
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/ticket', 'TicketController@index')->name('ticket');
Route::get('/ticket/show/{id}','TicketController@show')->where('id', '[0-9]+')->name('ticket.show');
Route::post('/ticket/{id}','TicketController@changeStatus')->where('id', '[0-9]+');
Route::get('/ticket/downloadPanel','TicketController@downloadPanel')->name('ticket.downloadPanel');
Route::post('/ticket/download','TicketController@download');

Route::get('/crm', 'CrmController@index')->name('crm');
Route::get('/crm/downloadPanel','CrmController@downloadPanel')->name('crm.downloadPanel');
Route::post('/crm/download','CrmController@download')->name('crm.download');
Route::get('/get-charts-ticket-data', 'GetChartDataController@getMonthlyTicketData');
Route::get('/get-charts-crm-data', 'GetChartDataController@getMonthlyCrmData');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::resource('/department', 'DepartmentController');
    Route::resource('/division', 'DivisionController');
    Route::resource('/district', 'DistrictController');
    Route::resource('/query-type', 'QueryTypeController');
    Route::resource('/complain-type', 'ComplainTypeController');
    Route::resource('/call-remarks', 'CallRemarkController');
    Route::resource('/assign-tickets', 'AssignTicketController');
    Route::resource('/escalations', 'EscalationController');
    Route::resource('/escalation-levels', 'EscalationLevelController');
    Route::resource('/escalation-matrix', 'EscalationMatrixController');
});
