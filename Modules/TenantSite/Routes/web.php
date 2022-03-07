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

use App\Http\Middleware\IdentifyCustomer;
use Illuminate\Http\Response;

Route::group([
    'prefix'     => '/{customer_name}',
    'middleware' => IdentifyCustomer::class,
    'as'         => 'customer:',
], function () {
    Route::prefix('/')->middleware(['verified','auth'])->group(function() {
        Route::get('/', 'TenantSiteController@index');
        Route::get('/test',function(){
            return new Response("TOTO");
        });
    });
});

