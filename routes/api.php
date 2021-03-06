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



Route::get('/folders/check/{folder}','FolderController@checkFolderAccessability');
Route::get('admin/folders/{folder}','FolderController@adminShow'); //admin verze getFolders vyžadující admin oprávnění
Route::apiResource('folders','FolderController');
Route::apiResource('passwords','PasswordController');
Route::apiResource('images','ImageController');
Route::apiResource('reviews', 'ReviewController');
Route::get('folderImages/{folder}', 'ImageController@getImages');
Route::get('admin/folderImages/{folder}', 'ImageController@adminGetImages'); //admin verze getImages vyžadující admin oprávnění
Route::apiResource('/social_links','SocialLinkController');
Route::post('/invitation','InvitationController@store');
Route::put('/invitation/{invitation}','InvitationController@verify');
Route::apiResource('/user','AdminController');
Route::post('/property/global-folders-password','PropertyController@setGlobalFoldersPassword');
Route::get('/property/global-folders-password','PropertyController@getGlobalFoldersPassword');
Route::post('/changePassword/{user}','AdminController@changePassword');

Route::group(['prefix' => '/v1', 'middleware' => 'auth:api'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});