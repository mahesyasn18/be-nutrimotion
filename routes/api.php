<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\User\UserActivityController;
use App\Http\Controllers\User\UserFoodController;
use App\Http\Controllers\User\UserWaterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['cors', 'json.response', 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
Route::post('/registers', [ApiAuthController::class, 'register'])->name('register.api');
Route::post('/is-emaill-exist', [ApiAuthController::class, 'checkEmail']);

Route::post('/login-admin', [ApiAuthController::class, 'loginadmin'])->name('login.api.admin');
Route::post('/register-admin', [ApiAuthController::class, 'registeradmin'])->name('register.api.admin');

// user group
Route::group(['middleware' => ['cors', 'json.response','auth:api']], function () {
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
    Route::put('/update-profile', [ApiAuthController::class, 'updateProfile'])->name('update.profile.api');
    Route::put('/update-personal-data', [ApiAuthController::class, 'updatePersonalData'])->name('update.personal.api');
    Route::put('/update-password', [ApiAuthController::class, 'changePassword'])->name('update.password.api');

    Route::post('/show-food', [UserFoodController::class, 'show']);
    Route::post('/check-food', [UserFoodController::class, 'checkfood']);
    Route::get('/get-all-food', [UserFoodController::class, 'getAllFood']);
    Route::get('/get-user-history-food', [UserFoodController::class, 'getUserHistoryFood']);

    Route::post('/add-eaten-food', [UserFoodController::class, 'storeEatenFood']);
    Route::get('/get-user-eaten-food', [UserFoodController::class, 'getUserEatenFood']);

    Route::post('/get-user-daily-nutrition', [UserFoodController::class, 'getUserDailyNutrition']);

    Route::get('/check-water', [UserWaterController::class, 'index']);
    Route::get('/drink-water', [UserWaterController::class, 'update']);

    Route::get('/get-activity', [UserActivityController::class, 'index']);
    Route::post('/detail/activity', [UserActivityController::class, 'show']);

    Route::get('/user/set-goal/show', [UserActivityController::class, 'userGetGoal']);
    Route::post('/user/set-goal', [UserActivityController::class, 'userStoreGoal']);
    Route::get('/user/all-activity', [UserActivityController::class, 'allActivity']);
    Route::post('/user/store-activity', [UserActivityController::class, 'storeDetailActivity']);
    Route::get('/user/calory', [UserActivityController::class, 'getCalories']);
});

// admin group
Route::group( ['middleware' => ['auth:admins-api'] ],function(){
    Route::post('/store-food', [FoodController::class, 'store']);
    Route::get('/activity', [ActivityController::class, 'index']);
    Route::post('/activity/store', [ActivityController::class, 'store']);
    Route::post('/store-nutrifact', [FoodController::class, 'storeNutriFact']);
});


