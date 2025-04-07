<?php

use Src\Route;

Route::add('GET', '/', [Controller\Api::class, 'index']);
Route::add('POST', '/echo', [Controller\Api::class, 'echo']);
Route::add('POST', '/login', [Controller\ApiAuthController::class, 'login']);
Route::group('/api', function () {
    Route::add('GET', '/protected', [Controller\Api::class, 'protectedData'])->middleware('apiAuth');
    Route::add('POST', '/logout', [Controller\ApiAuthController::class, 'logout'])->middleware('apiAuth');
});