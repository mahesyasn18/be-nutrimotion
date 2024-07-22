<?php

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin\FoodController;



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

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'registerView'])->name('registerView');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/', [PagesController::class, 'viewDashboard'])->name('index');


    //Dashboards
    Route::get('dashboard', [PagesController::class, 'viewDashboard'])->name('dashboard');

    //Users
    Route::get('/users', [PagesController::class, 'viewUsers'])->name('users');
    Route::get('/users/add-user', [PagesController::class, 'viewUserForm'])->name('add-user-form');
    Route::get('/users/edit-user/{id}', [PagesController::class, 'viewUserUpdateForm'])->name('edit-user-form');
    Route::post('/users/add-user', [UserController::class, 'store'])->name('user-store');
    Route::put('/users/edit-user/{id}', [UserController::class, 'update'])->name('user-update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user-destroy');


    //Foods
    Route::get('/foods', [PagesController::class, 'viewFoods'])->name('foods');
    Route::get('/foods/add-food', [PagesController::class, 'viewFoodForm'])->name('add-food-form');
    Route::get('/foods/edit-food/{id}', [PagesController::class, 'viewFoodUpdateForm'])->name('edit-food-form');
    Route::post('/foods/add-food', [FoodController::class, 'store'])->name('food-store');
    Route::put('/foods/edit-food/{id}', [FoodController::class, 'update'])->name('food-update');
    Route::delete('/foods/{id}', [FoodController::class, 'destroy'])->name('food-destroy');
    
    Route::get('/foods/food-detail/{id}', [PagesController::class, 'viewFoodDetail'])->name('food-detail');

    // Route::get('/nutritions', [PagesController::class, 'viewNutritions'])->name('nutritions');

    //Activities
    Route::get('/activities', [PagesController::class, 'viewActivities'])->name('activities');
    Route::get('/activities/add-activity', [PagesController::class, 'viewActivityForm'])->name('add-activity-form');
    Route::get('/activities/edit-activity/{id}', [PagesController::class, 'viewActivityUpdateForm'])->name('edit-activity-form');
    Route::post('/activities/add-activity', [ActivityController::class, 'store'])->name('activity-store');
    Route::put('/activities/edit-activity/{id}', [ActivityController::class, 'update'])->name('activity-update');
    Route::delete('/activities/{id}', [ActivityController::class, 'destroy'])->name('activity-destroy');

    Route::get('/activities/activity-detail/{id}', [PagesController::class, 'viewActivityDetail'])->name('activity-detail');
});
