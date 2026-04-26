<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VetementController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MesureController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('client.logout');

Route::middleware(['auth:client'])->group(function () {
    Route::get('/vetements', [VetementController::class, 'index'])->name('vetements.index');
    Route::get('/vetements/{id}', [VetementController::class, 'show'])->name('vetements.show');
    
    Route::get('/rendezvous/create', [RendezVousController::class, 'create'])->name('rendezvous.create');
    Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
    Route::get('/rendezvous', [RendezVousController::class, 'myRendezVous'])->name('rendezvous.index');
    Route::put('/rendezvous/{id}/confirmer', [RendezVousController::class, 'confirmByClient'])->name('rendezvous.confirm');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('checkLogin');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
        Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');
        
        Route::get('/vetements', [AdminController::class, 'vetementsIndex'])->name('vetements.index');
        Route::get('/vetements/create', [AdminController::class, 'vetementsCreate'])->name('vetements.create');
        Route::post('/vetements', [AdminController::class, 'vetementsStore'])->name('vetements.store');
        Route::get('/vetements/{id}/edit', [AdminController::class, 'vetementsEdit'])->name('vetements.edit');
        Route::put('/vetements/{id}', [AdminController::class, 'vetementsUpdate'])->name('vetements.update');
        Route::delete('/vetements/{id}', [AdminController::class, 'vetementsDestroy'])->name('vetements.destroy');
        
        Route::get('/rendezvous', [AdminController::class, 'rendezvousIndex'])->name('rendezvous.index');
        Route::get('/rendezvous/{id}', [AdminController::class, 'rendezvousShow'])->name('rendezvous.show');
        Route::get('/rendezvous/{id}/confirmer', [AdminController::class, 'rendezvousConfirmer'])->name('rendezvous.confirmer');
        Route::get('/rendezvous/{id}/refuser', [AdminController::class, 'rendezvousRefuser'])->name('rendezvous.refuser');
        
        Route::get('/mesures/{clientId}/create', [MesureController::class, 'create'])->name('mesures.create');
        Route::post('/mesures/{clientId}', [MesureController::class, 'store'])->name('mesures.store');
        Route::get('/mesures/{clientId}', [MesureController::class, 'show'])->name('mesures.show');
        Route::get('/mesures/{clientId}/historique', [MesureController::class, 'historique'])->name('mesures.historique');
        
        Route::get('/clients', [AdminController::class, 'clientsIndex'])->name('clients.index');
    });
});