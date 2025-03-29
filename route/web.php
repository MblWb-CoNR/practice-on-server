<?php

use Controller\Site;
use Controller\BuildingController;
use Controller\RoomController;
use Controller\UserController;
use Src\Route;

// Публичные маршруты
Route::add('GET', '/', [Site::class, 'hello']);
Route::add(['GET', 'POST'], '/login', [Site::class, 'login']);
Route::add('GET', '/logout', [Site::class, 'logout']);
Route::add('GET', '/functions', [Controller\Site::class, 'functions'])->middleware('auth');

// Защищенные маршруты
Route::add('GET', '/hello', [Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Site::class, 'signup'])->middleware('auth');

// Маршруты для работы с помещениями и зданиями
Route::add('GET', '/buildings', [BuildingController::class, 'index'])->middleware('auth');
Route::add(['GET', 'POST'], '/buildings/create', [BuildingController::class, 'create'])->middleware('auth');
Route::add('GET', '/building/rooms', [BuildingController::class, 'rooms'])->middleware('auth');
Route::add('GET', '/building/stats', [BuildingController::class, 'stats'])->middleware('auth');

Route::add('GET', '/rooms', [RoomController::class, 'index'])->middleware('auth');
Route::add(['GET', 'POST'], '/rooms/create', [RoomController::class, 'create'])->middleware('auth');

// Маршруты администратора
Route::add('GET', '/users', [Controller\UserController::class, 'index'])->middleware('admin');
Route::add(['GET', 'POST'], '/users/create', [Controller\UserController::class, 'create'])->middleware('admin');

// Для сотрудника
Route::add('GET', '/building', [Controller\BuildingController::class, 'index'])->middleware('employee');
Route::add(['GET', 'POST'], '/building/create', [Controller\BuildingController::class, 'create'])->middleware('employee');

