<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;





Route::group(['prefix'=>'order'], function(){
    Route::get('{id}', [OrderController::class, 'show']);
    Route::get('{id}/label', [OrderController::class, 'label']);
});

