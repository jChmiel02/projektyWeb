<?php

use App\Http\Controllers\celOszczedzaniaController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\pracaController;
use App\Http\Controllers\dodatkoweDochodyController;
use App\Http\Controllers\limitController;
use App\Http\Controllers\rejestracjaKontroler;
use App\Http\Controllers\staleDochodyController;
use App\Http\Controllers\staleWydatkiController;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\wydatkiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('user',[UserAuth::class,'login']);

// Login route
Route::get('/login', function (){
    if (session()->has('user')){
        return redirect('home');
    }
    return view('login');
});
Route::post('login', [UserAuth::class, 'login']);
Route::get('/logout', function (){
    if (session()->has('user')){
        session()->pull('user');
    }
    return redirect('login');
});

// Rejestracja route
Route::view('rejestracja','register');
Route::POST('rejestracja',[rejestracjaKontroler::class,'register']);
Route::get('/check-username', [rejestracjaKontroler::class, 'checkUsernameAvailability']);

// Praca route
Route::post('/save-data', [pracaController::class, 'zapiszDane'])->name('zapiszDane');
Route::view('pracaFormularz','pracaFormularz');
Route::delete('/praca/delete/{id}', [pracaController::class, 'usunPraca'])->name('usunPraca');
Route::put('/praca/update/{id}', [pracaController::class, 'edytujPraca'])->name('edytujPraca');

// Stałe wydatki route
Route::post('/staleWydatki', [staleWydatkiController::class, 'staleWydatki'])->name('staleWydatki');
Route::view('staleWydatkiFormularz','staleWydatkiFormularz');
Route::put('/staleWydatki/edit/{id}', [staleWydatkiController::class, 'updateStalyWydatek'])->name('updateStalyWydatek');
Route::delete('/staleWydatki/delete/{id}', [staleWydatkiController::class, 'deleteStalyWydatek'])->name('deleteStalyWydatek');

// Wydatki route
Route::post('/wydatki', [wydatkiController::class, 'wydatki'])->name('wydatki');
Route::view('wydatkiFormularz','wydatkiFormularz');
Route::put('/wydatki/edit/{id}', [wydatkiController::class, 'updateWydatek'])->name('updateWydatek');
Route::delete('/wydatki/delete/{id}', [wydatkiController::class, 'deleteWydatek'])->name('deleteWydatek');

// Dodatkowe dochody route
Route::post('/dodatkoweDochody', [dodatkoweDochodyController::class, 'dodatkoweDochody'])->name('dodatkoweDochody');
Route::view('dodatkoweDochodyFormularz','dodatkoweDochodyFormularz');
Route::put('/dodatkoweDochody/edit/{id}', [dodatkoweDochodyController::class, 'updateDodatkoweDochody'])->name('updateDodatkoweDochody');
Route::delete('/dodatkoweDochody/delete/{id}', [dodatkoweDochodyController::class, 'deleteDodatkoweDochody'])->name('deleteDodatkoweDochody');

// Stałe dochody route
Route::post('/staleDochody', [staleDochodyController::class, 'staleDochody'])->name('staleDochody');
Route::view('staleDochodyFormularz','staleDochodyFormularz');
Route::put('/staleDochody/edit/{id}', [staleDochodyController::class, 'updateStaleDochody'])
    ->name('updateStaleDochody');
Route::delete('/staleDochody/delete/{id}', [staleDochodyController::class, 'deleteStaleDochody'])
    ->name('deleteStaleDochody');

// Limit route
Route::view('limit','limit');
Route::get('/limit', [limitController::class, 'limit'])->name('limit');
Route::post('/limit', [limitController::class, 'ustawLimit'])->name('ustawLimit');

// Cel oszczedzania route
Route::view('celOszczedzaniaFormularz','celOszczedzaniaFormularz');
Route::post('/zrealizujCel/{id}', [celOszczedzaniaController::class, 'zrealizujCel'])->name('zrealizujCel');
Route::get('/cel-oszczedzania-formularz', [CelOszczedzaniaController::class, 'showCreateForm'])->name('celOszczedzaniaFormularz');
Route::post('/tworzenie-celu-oszczedzania', [CelOszczedzaniaController::class, 'tworzenieCeluOszczedzania'])->name('tworzenieCeluOszczedzania');
Route::delete('/usun-cel/{id}', [CelOszczedzaniaController::class, 'usunCel'])->name('usunCel');
Route::put('/update-cel-oszczedzania/{id}', [CelOszczedzaniaController::class, 'updateCelOszczedzania'])->name('updateCelOszczedzania');

// Home route
Route::view('home','home');
Route::get('/home', [homeController::class, 'wyswietl'])->name('wyswietl');
