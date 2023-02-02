<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\XmlController;
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

Route::get('/', [OrganizationsController::class, 'index']);
Route::resource('organizations', OrganizationsController::class)->except([
    'index'
]);;
Route::resource('users', UsersController::class);
Route::resource('xml', XmlController::class);