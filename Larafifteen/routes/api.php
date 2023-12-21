<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ProduitController;
use App\Models\Article;
use App\Models\Categorie;
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

Route::get('/index', [TacheController::class, 'index']);
Route::get('/show', [TacheController::class, 'show']);

Route::get('eleves', [EleveController::class, 'index']);
Route::get('eleves/{position}', [ EleveController::class, 'show']);
Route::post('eleve', [ EleveController::class, 'store']);

//Afficher les produits
Route::get('produits', [ProduitController::class, 'index']);

//Afficher un produit spécifique
Route::get('produits/{id}', [ ProduitController::class, 'show']);

//Ajouter un produit
Route::post('produits', [ ProduitController::class, 'store']);

//Modifier un produit
Route::put('produits/{id}', [ ProduitController::class, 'update']);

//Supprimer les produits
Route::delete('produits', [ ProduitController::class, 'destroy']);



//Afficher les categories
Route::get('categories', [CategorieController::class, 'index']);

//Afficher une categorie spécifique
Route::get('categories/{id}', [ CategorieController::class, 'show']);

//Ajouter une categorie
Route::post('categories', [ CategorieController::class, 'store']);

//Modifier une categorie
Route::put('categories/{id}', [ CategorieController::class, 'update']);

//Supprimer une categorie
Route::delete('categories/{id}', [ CategorieController::class, 'destroy']);



//Afficher les article
Route::get('articles', [ArticleController::class, 'index']);

//Afficher une categorie spécifique
Route::get('articles/{id}', [ ArticleController::class, 'show']);

//Ajouter une article
Route::post('articles', [ ArticleController::class, 'store']);

//Modifier une article
Route::put('articles/{id}', [ ArticleController::class, 'update']);

//Supprimer une article
Route::delete('articles/{id}', [ ArticleController::class, 'destroy']);
