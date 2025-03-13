<?php

use App\Http\Controllers\PointsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PolylineController;
use App\Http\Controllers\PolygonController;

use Illuminate\Support\Facades\Route;
use Laravel\Prompts\Table;

Route::get('/', [PointsController::class, 'index'])->name('map');

Route::get('/table', [TableController::class, 'index'])->name('table');

Route::resource('points', PointsController::class);
Route::resource('polyline', PolylineController::class);
Route::resource('polygon', PolygonController::class);

