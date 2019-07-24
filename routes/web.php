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
    return view('index');
})->name('index');

Route::get('/login', function () {

    return view('login');
})->name('login');


Route::get('/account/{type}', function ($type) {
    $userInfo = Session::get('user');
    if ($userInfo['info'][1]==3) {
        return view("account")->with('accountpage',$type);
    } else {
        Session::flash('ID_error','You can not visit that page!');
        return redirect('/dashboard');
    }


});

Route::get('/project/{action}', function ($action) {
    return view("group.$action")->with('accountpage',$action);
});

Route::get('/myproject/{action}', function ($action) {
    $userInfo = Session::get('user');
    $pid=$userInfo['info'][2];
     return view("myproject.$action")->with('action',$action)->with('pid',$pid);


});

Route::get('/dashboard','PageControllers@dashboard')->name('dashboard');;

Route::get('/logout','PageControllers@logout');
//POST
Route::post('/auth', 'PageControllers@login');
Route::post('/upload', 'PageControllers@upload');
Route::post('/update/{action}','UserControllers@update');
Route::post('/create/{action}','UserControllers@create');
Route::post('/timeset','UserControllers@timeset');

