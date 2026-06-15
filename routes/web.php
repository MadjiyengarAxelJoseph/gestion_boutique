<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;

Route::get('/', function () {
    return redirect()->route('clients.index');
});

Route::resource('clients', ClientController::class);
Route::resource('produits', ProduitController::class);
Route::resource('commandes', CommandeController::class);Route::get('/commandes/{commande}/pdf', [CommandeController::class, 'genererPdf'])->name('commandes.pdf');

