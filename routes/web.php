<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\HotelController;
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

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::post('hotels/filter',[HotelController::class,'filterHotels'])->name('hotels.filter');
    Route::post('hotels/find',[HotelController::class,'findHotels'])->name('hotels.find');
    Route::get('hotels/order/{field}',[HotelController::class,'orderHotels'])->name('hotels.order');

    Route::resources([
        'country'=> CountryController::class,
        'hotels'=>HotelController::class
    ]);
    Route::get('country/{id}/hotels',[HotelController::class,'countryHotels'])->name('countryHotels');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
