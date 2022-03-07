<?php

use Illuminate\Support\Facades\Route;

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

//Group routes to go through auth & verified middlewares
Route::middleware('auth')->group(function (){

    //Home page
    Route::view('/home', 'home')->name('home');

    //Edit profile page
    Route::view('/profile/edit', 'profile.edit-profile')->name('profile.edit');

    //Edit password page
    Route::view('/password/edit', 'profile.edit-password')->name('password.edit');

    //Toggle two factor authentication page
    Route::get('/two-factor-authentication/toggle', 'App\Http\Controllers\TwoFactorAuthController@toggle')->name('two-factor-authentication.toggle');

    Route::delete('/two-factor-authentication/abort', 'App\Http\Controllers\TwoFactorAuthController@abort')->name('two-factor-authentication.abort');

    Route::post('/two-factor-authentication/confirm', 'App\Http\Controllers\TwoFactorAuthController@confirm')->name('two-factor-authentication.confirm');

    Route::post('/user/two-factor-recovery-codes/email', 'App\Http\Controllers\EmailController@sendTwoFactorRecoveryCodes')->name('two-factor-recovery-codes.send');
});
