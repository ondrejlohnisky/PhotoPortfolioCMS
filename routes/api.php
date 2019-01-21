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



Route::apiResource('folders','FolderController');
Route::get('/folders/check/{folder}','FolderController@checkFolderAccessability');
Route::get('admin/folders/{folder}','FolderController@adminShow');
Route::apiResource('passwords','PasswordController');
Route::apiResource('images','ImageController');
Route::get('folderImages/{folder}', 'ImageController@getImages');
Route::get('admin/folderImages/{folder}', 'ImageController@adminGetImages');

Route::group(['prefix' => '/v1', 'middleware' => 'auth:api'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});