<?php

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

Auth::routes();

use App\Http\Controllers\SauceController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/sauces', [SauceController::class, 'index']);
    Route::get('/home', [SauceController::class, 'index']);
    Route::get('/', [SauceController::class, 'index']);
    Route::get('/sauces/create', [SauceController::class, 'create']);
    Route::post('/sauces', [SauceController::class, 'store']);
    Route::get('/sauces/{id}', [SauceController::class, 'show']);
    Route::put('/sauces/{id}', [SauceController::class, 'update']);
    Route::delete('/sauces/{id}', [SauceController::class, 'destroy']);
    Route::post('/sauces/{id}/like', [SauceController::class, 'like']);
    Route::post('/sauces/{id}/dislike', [SauceController::class, 'dislike']);
});


Route::get('/sauces', [SauceController::class, 'index'])->name('sauces.index');  // Liste des sauces
Route::get('/sauces/create', [SauceController::class, 'create'])->name('sauces.create');  // Créer des sauces
Route::post('/sauces', [SauceController::class, 'store'])->name('sauces.store');  // Liste des sauces
Route::get('/sauces/{id}', [SauceController::class, 'show'])->name('sauces.show');  // Afficher une sauce
Route::get('/sauces/{id}/edit', [SauceController::class, 'edit'])->name('sauces.edit');  // Modifier une sauce
Route::put('/sauces/{id}', [SauceController::class, 'update'])->name('sauces.update');  // Mettre à jour une sauce
Route::delete('/sauces/{id}', [SauceController::class, 'destroy'])->name('sauces.destroy');  // Supprimer une sauce

