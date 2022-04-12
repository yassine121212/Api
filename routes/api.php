<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
 
Route::group(['middleware' => ['api','checkPassword'],'namespace' =>'Api'],function(){
    Route::Post('/pro','ProductsController@index');
    Route::Post('/get_pro','ProductsController@get_pro_byId');
    Route::Post('/change_statut','ProductsController@ChangeStatut');
     
                    Route::group(['prefix' => 'admin','namespace' =>'Admin'],function(){
                                Route::post('login','AuthController@login');
                                Route::post('logout','AuthController@logout')->middleware('auth.guard:admin-api');
                                
                                Route::post('profile',function(){
                                    return Auth::user();
                                 })->middleware('auth.guard:admin-api');
                            }); 
                    Route::group(['prefix'=>'user','namespace' =>'User'],function(){
                                Route::post('login','AuthController@login');
                    });                 
                                                        
                    Route::group(['prefix' => 'user','middleware' =>'auth.guard:user-api'],function(){
                                Route::post('profile',function(){
                                   return Auth::user();
                                });

                                                                                    });
});
Route::group(['middleware' => ['api','checkPassword','checkAdminToken:admin-api'],'namespace' =>'Api'],function(){
    Route::get('offers','ProductsController@index');
});