<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Application User Routes
Route::post('userlogin','UserController@userLogin');
Route::post('userprofile','UserController@getUserProfile');
//Forget Password API
Route::post('forget-password-mail','UserController@checkForgetPasswordEmail');
Route::post('update-password','UserController@updateForgetPassword');
Route::get('update/password/{id}','UserController@getUserinfoWithForgetPasswordLink');
//update user info API
Route::post('updateuserprofile','UserController@updateUserProfile');
//Twilio Route
Route::post('twilio-information','TwilioController@storeTwilioInformation');
Route::post('get-twilio-information','TwilioController@getTwilioInformation');
//Admin Registration
Route::post('admin-registration','UserController@adminRegistration');
//Admin List
Route::get('admin-list','UserController@adminList');
//View Admin
Route::post('view-admin','UserController@viewAdmin');
//Emulate User
Route::post('emulate-user','UserController@emulateUser');
//Block User
Route::post('block-user','UserController@blockUser');
//Unblock user
Route::post('unblock-user','UserController@unblockUser');

//User logOut
Route::any('log-out','UserController@logOut');
//create Department
Route::post('create-department','DepartmentController@createDepartment');
//edit Department
Route::post('edit-department','DepartmentController@editDepartment');
//view Department
Route::post('view-department','DepartmentController@viewDepartment');
//Depaerment List
Route::post('department-list','DepartmentController@departmentList');
// Agent register
Route::post('agent-register','UserController@agentRegister');
// Agent List of an Admin or SuperAdmin
Route::post('listofAgent','UserController@listofAgent');
// Edit Agent
Route::post('agent-update','UserController@updateAgent');
// Block Unblock Agent
Route::post('agent-status-update','UserController@agentStatusUpdate');
//view Agent
Route::post('view-agent','UserController@viewAgent');
// validate Twilio Credentials
Route::get('validate-twilio-credentials','TwilioController@validateTwilioCredentials');
// Twilio Account List
Route::get('twilio-account-list','TwilioController@twilioAccountList');
// Get available phone numbers from Twilio
Route::get('getPurchasedPhoneNumber/{widgetId}/{userId}/{areaCode}', 'TwilioController@getPurchasedPhoneNumber');
// create Widgets
Route::post('createWidgets', 'WidgetController@createWidgets');
// Get list of Widgets
Route::post('listWidgets', 'WidgetController@listWidgets');
//Create Twilio SID for Admin User
Route::post('create-user-twilio-sid','UserController@createUserTwilioSid');

// Update Widgets
Route::post('updateWidgets', 'WidgetController@updateWidgets');
// Widget Department Mapping
Route::post('updateWidgetDepartment', 'WidgetController@updateWidgetDepartment');
// Widget Schedule Mapping
Route::post('updateWidgetSchedule', 'WidgetController@updateWidgetSchedule');
// View Widget
Route::post('viewWidgets', 'WidgetController@viewWidgets');
//Timezone API
Route::get('get-timezone', 'WidgetController@getTimezones');
//widget data API
Route::post('widget-data', 'WidgetController@getWidgetData');
//reset password API
Route::post('reset-password','UserController@resetPassword');
//get widget departments
Route::post('widget-departments', 'WidgetController@getWidgetDepartments');

//get widget departments
Route::get('messages', 'MessageController@getMessage');

Route::post('add-messages', 'MessageController@addMessage');
Route::post('add-chat-user', 'MessageController@addUser');
Route::post('accept-chat-request', 'MessageController@acceptRequest');
Route::post('reject-chat-request', 'MessageController@rejectRequest');

Route::get('get-agents', 'MessageController@getAgents');
// Route::get('agent-chat', 'MessageController@getAgent');
Route::get('/fire', function () {
    // this fires the event
    $messge  = array(
    	'message' => '',
    	'from_number' => 42 );
    broadcast(new App\Events\SocketMessage($messge))->toOthers();
    return "event fired";
});