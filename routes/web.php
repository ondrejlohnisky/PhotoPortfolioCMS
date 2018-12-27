<?php
use Illuminate\Http\Request;
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

// Route::get('/', function () {
//     return redirect('/home');
// });

// Route::get('/home', function () {
//     return view('home');
// });

// Route::get('/{vue_capture?}',function(Request $request){
//     return view('page');
// })->where('vue_capture', '[\w\.-]*')->name('vue')->middleware('filterWeb');


Route::get('/{vue}',function(Request $request){
    return view('page');
})->where('vue','(|home|portfolio|bts|kontakt|review|folder\/[\d]*)');

Route::get('/admin',function(Request $request){
    return redirect('admin/dashboard');
});


//auth 
Route::group(['prefix' => 'admin'], function(){
    Route::get('/{adminVue}','AdminController@showPage')->where('adminVue','|dashboard|sprava_slozek');
    Auth::routes();
});

