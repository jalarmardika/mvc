<?php 
require_once '../vendor/autoload.php';
require_once '../app/config/config.php';

use App\Core\Route;
use App\Controllers\ProductController;

if( !session_id() ) session_start();

Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/create', [ProductController::class, 'create']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
Route::post('/product/{id}', [ProductController::class, 'update']);
Route::get('/product/{id}/delete', [ProductController::class, 'delete']);

Route::run();