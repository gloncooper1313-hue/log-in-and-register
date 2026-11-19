
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OneToOneController;
use App\Http\Controllers\OneToManyController;
use App\Http\Controllers\ManyToManyController;


// GUEST ROUTES - only users who are not logged in

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'loginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'registerForm'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

});


// AUTHENTICATED ROUTES - only logged-in users

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // ONE-TO-ONE

    Route::prefix('users')->name('users.')->group(function () {

    Route::get('/', [OneToOneController::class, 'index'])
        ->name('index');

    Route::get('/create', [OneToOneController::class, 'create'])
        ->name('create');

    Route::post('/', [OneToOneController::class, 'store'])
        ->name('store');

    });


    // ONE-TO-MANY

    Route::prefix('one-to-many')
        ->name('one-to-many.')
        ->controller(OneToManyController::class)
        ->group(function () {

            Route::get('/', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/', 'store')->name('store');

        });


    // MANY-TO-MANY

    Route::prefix('many-to-many')
        ->name('many-to-many.')
        ->controller(ManyToManyController::class)
        ->group(function () {

            Route::get('/', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/', 'store')->name('store');

        });

});
