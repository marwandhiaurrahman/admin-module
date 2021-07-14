<?php

use App\Http\Controllers\DependentDropdownController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dependent-dropdown', [DependentDropdownController::class, 'index'])
    ->name('dependent-dropdown.index');
Route::get('city/{id}', [DependentDropdownController::class, 'city'])
    ->name('dependent-dropdown.city');
Route::get('district/{id}', [DependentDropdownController::class, 'district'])
    ->name('dependent-dropdown.district');
Route::get('village/{id}', [DependentDropdownController::class, 'village'])
    ->name('dependent-dropdown.village');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('updateprofile/{id}', [UserController::class, 'updateprofile'])->name('updateprofile');

    Route::prefix('admin')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
});
