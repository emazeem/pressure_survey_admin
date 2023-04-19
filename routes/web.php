<?php
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/',function (){
    return redirect()->to('login');
});
Route::group([],__DIR__.'/partials/super_admin.php');
