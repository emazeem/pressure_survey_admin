<?php
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Artisan;
Auth::routes();
Route::get('/',function (){
    return redirect()->to('login');
});
Route::get('/commands',function (){
    Artisan::call('optimize');
    dd(1);
});

Route::group([],__DIR__.'/partials/super_admin.php');
