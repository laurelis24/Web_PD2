<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;

Route::get('/', [HomeController::class, 'index']);

/// Manufactureres
Route::get('/manufacturers', [ManufacturerController::class, 'list']);
Route::get('/manufacturers/create', [ManufacturerController::class, 'create']);
Route::post('/manufacturers/put', [ManufacturerController::class, 'put']);
Route::get('/manufacturers/update/{manufacturer}', [ManufacturerController::class, 'update']);
Route::post('/manufacturers/patch/{manufacturer}', [ManufacturerController::class, 'patch']);
Route::post('/manufacturers/delete/{manufacturer}', [ManufacturerController::class, 'delete']);


// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);


//Cars
Route::get('/cars', [CarController::class, 'list']);
Route::get('/cars/create', [CarController::class, 'create']);
Route::post('/cars/put', [CarController::class, 'put']);
Route::get('/cars/update/{car}', [CarController::class, 'update']);
Route::post('/cars/patch/{car}', [CarController::class, 'patch']);
Route::post('/cars/delete/{car}', [CarController::class, 'delete']);
// Extra car view
Route::get('/cars/{car}', [CarController::class, 'singleView']);

//Categories
Route::get('/categories', [CategoryController::class, 'list']);
Route::get('/categories/create', [CategoryController::class, 'create']);
Route::post('/categories/put', [CategoryController::class, 'put']);
Route::get('/categories/update/{category}', [CategoryController::class, 'update']);
Route::post('/categories/patch/{category}', [CategoryController::class, 'patch']);
Route::post('/categories/delete/{category}', [CategoryController::class, 'delete']);



// Data/API
Route::get('/data/get-top-cars', [DataController::class, 'getTopCars']);
Route::get('/data/get-car/{car}', [DataController::class, 'getCar']);
Route::get('/data/get-related-cars/{car}', [DataController::class, 'getRelatedCars']);
Route::get('/data/get-not-related-cars/{car}', [DataController::class, 'getNotRelatedCars']);