<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/Admin',function (){
    return view('Dashbord');
});
Route::group(['prefix' => 'Admin/slider'], function () {
    Route::get('/',[\App\Http\Controllers\SliderController::class,'upload']);
    Route::post('/store',[\App\Http\Controllers\SliderController::class,'store']);
    Route::delete('/delete/{idslide}',[\App\Http\Controllers\SliderController::class,'del']);
})->middleware('Auth');

Route::get('/checkphone', [\App\Http\Controllers\UserController::class, 'checkphone']);
Route::post('/store', [\App\Http\Controllers\UserController::class, 'store']);
Route::get('/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::get('/sign', [\App\Http\Controllers\UserController::class, 'sign']);
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout']);
Route::post('/checklogin', [\App\Http\Controllers\UserController::class, 'checklogin']);

Route::group(['prefix' => 'Admin/category'], function () {
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'show']);
    Route::post('/store', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::delete('/delete/{id}',[\App\Http\Controllers\CategoryController::class,'delete']);
    Route::get('/edit/{id}',[\App\Http\Controllers\CategoryController::class,'edit']);
    Route::post('/update/{id}',[\App\Http\Controllers\CategoryController::class,'update']);
})->middleware('Auth');

Route::group(['prefix' => 'Admin/food'],function (){
   Route::get('/add',[\App\Http\Controllers\FoodController::class,'add']);
   Route::post('/store',[\App\Http\Controllers\FoodController::class,'store']);
   Route::get('/list',[\App\Http\Controllers\FoodController::class,'list']);
   Route::get('/edit/{id}',[\App\Http\Controllers\FoodController::class,'edit']);
   Route::post('/update/{id}',[\App\Http\Controllers\FoodController::class,'update']);
   Route::delete('/delete/{id}',[\App\Http\Controllers\FoodController::class,'delete']);
});

Route::group(['prefix' => 'order'],function (){
    Route::post('/add/{food_id}',[\App\Http\Controllers\OrderController::class,'add']);
    Route::get('/',[\App\Http\Controllers\OrderController::class,'list']);
    Route::post('/confirmedorder/{order_id}',[\App\Http\Controllers\OrderController::class,'confirmed']);
    Route::get('/history/{user_id}',[\App\Http\Controllers\OrderController::class,'history']);
    Route::post('/Delivery_food',[\App\Http\Controllers\OrderController::class,'delivery']);
    Route::post('/updatestatus/{order_id}',[\App\Http\Controllers\OrderController::class,'update_status']);
    Route::post('/test',[\App\Http\Controllers\OrderController::class,'tarikh']);
});

Route::group(['prefix' => 'item'],function (){
    Route::delete('/delete/{item_id}',[\App\Http\Controllers\ItemController::class,'delete']);
    Route::post('/update/{item_id}',[\App\Http\Controllers\ItemController::class,'update']);
});

Route::group(['prefix' => 'user'],function (){
    Route::get('/edit',[\App\Http\Controllers\UserController::class,'edit']);
    Route::post('/update/{userid}',[\App\Http\Controllers\UserController::class,'update']);
    Route::post('/Admin/find',[\App\Http\Controllers\UserController::class,'find']);
    Route::delete('/Admin/delete/{userid}',[\App\Http\Controllers\UserController::class,'delete']);
});
