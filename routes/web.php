<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\GreenhouseController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\JenisTanamanController;
use App\Http\Controllers\MqttController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('/dashboard', [SensorController::class, 'index'])->name('dashboard');

	Route::get('greenhouse-manage', function () {
		return view('greenhouse-manage');
	})->name('Greenhouse Management');

	Route::get('/greenhouse-manage', [GreenhouseController::class, 'index'])->name('greenhouse-manage');

	Route::get('/greenhouses/create', [GreenhouseController::class, 'create'])->name('greenhouses.create');
	Route::post('/greenhouses', [GreenhouseController::class, 'store'])->name('greenhouses.store');
	Route::get('/greenhouses/{id_greenhouse}/edit', [GreenhouseController::class, 'edit'])->name('greenhouses.edit');
	Route::put('/greenhouses/{id_greenhouse}', [GreenhouseController::class, 'update'])->name('greenhouses.update');
	Route::delete('/greenhouses/{id_greenhouse}', [GreenhouseController::class, 'destroy'])->name('greenhouses.destroy');
	Route::get('/greenhouses/{id_greenhouse}', [GreenhouseController::class, 'show1'])->name('greenhouses.view');

	Route::put('greenhouses/{id_greenhouse}/periode-tanam', [GreenhouseController::class, 'updatePeriodeTanam'])->name('periode-tanam.update');
	// Route::post('greenhouses/{id_greenhouse}/periode-tanam', [GreenhouseController::class, 'updatePeriodeTanam'])->name('periode-tanam.update');
	
	Route::get('greenhouses/{id_greenhouse}/create-periode', [GreenhouseController::class, 'createPeriodeTanam'])->name('periode-tanam.create');

	// Menyimpan periode tanam
	Route::post('greenhouses/{id_greenhouse}/store-periode', [GreenhouseController::class, 'storePeriodeTanam'])->name('periode-tanam.store');
	Route::delete('periode-tanam/{id}', [GreenhouseController::class, 'destroyPeriodeTanam'])->name('periode-tanam.destroy');
	
	
	Route::get('greenhouses/{id_greenhouse}/periode-tanam', [GreenhouseController::class, 'showPeriodeTanam'])->name('periode-tanam.show');


	
	Route::get('/jenis-tanaman', [JenisTanamanController::class, 'index'])->name('jenis-tanaman');
	Route::get('/jenis_tanaman/create', [JenisTanamanController::class, 'create'])->name('jenis_tanaman.create');
	Route::get('/jenis_tanaman/{id_jenis}/edit', [JenisTanamanController::class, 'edit'])->name('jenis_tanaman.edit');
	Route::post('/jenis_tanaman', [JenisTanamanController::class, 'store'])->name('jenis_tanaman.store');
	Route::put('/jenis_tanaman/{id_jenis}', [JenisTanamanController::class, 'update'])->name('jenis_tanaman.update');
	Route::delete('/jenis_tanaman/{id_jenis}', [JenisTanamanController::class, 'destroy'])->name('jenis_tanaman.destroy');
	Route::get('/threshold-data/{id_jenis}', [JenisTanamanController::class, 'getDataThres']);
	

	// List all sensors
	Route::get('/sensors', [SensorController::class, 'index'])->name('sensors.index');
	Route::get('/sensors-data', [SensorController::class, 'getData'])->name('getSensorData');
	Route::get('/sensors-data2', [SensorController::class, 'getData2'])->name('getSensorData2');
	
	// Show a specific sensor by ID
	Route::get('/sensors/{id}', [SensorController::class, 'show'])->name('sensors.show');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	// Route::get('user-management', function () {
	// 	$users = User::all();
	// 	return view('laravel-examples/user-management');
	// })->name('user-management');

	// Route::get('user-management', [InfoUserController::class, 'index']);
	Route::get('/users', [InfoUserController::class, 'index']);

	
	

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);

	// Route::get('/user-profile', [InfoUserController::class, 'create']);
	// Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/users/create', [InfoUserController::class, 'create'])->name('users.create');
	Route::post('/users', [InfoUserController::class, 'store'])->name('users.store');

    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');




Route::post('/mqtt/publish', [MqttController::class, 'publish']);
Route::get('/mqtt/subscribe', [MqttController::class, 'subscribe']);
Route::get('/mqtt', function () {
    return view('mqtt');
});
