<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Personne;
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
Route::get('eleves/{position}', [EleveController::class, 'show']);
Route::post('eleve', [EleveController::class, 'store']);

//Afficher les produits
Route::get('produits', [ProduitController::class, 'index']);

//Afficher un produit spécifique
Route::get('produits/{id}', [ProduitController::class, 'show']);

//Ajouter un produit
Route::post('produits', [ProduitController::class, 'store']);

//Modifier un produit
Route::put('produits/{id}', [ProduitController::class, 'update']);

//Supprimer les produits
Route::delete('produits', [ProduitController::class, 'destroy']);



//Afficher les categories
Route::get('categories', [CategorieController::class, 'index']);

//Afficher une categorie spécifique
Route::get('categories/{id}', [CategorieController::class, 'show']);

//Ajouter une categorie
Route::post('categories', [CategorieController::class, 'store']);

//Modifier une categorie
Route::put('categories/{id}', [CategorieController::class, 'update']);

//Supprimer une categorie
Route::delete('categories/{id}', [CategorieController::class, 'destroy']);



//Afficher les article
Route::get('articles', [ArticleController::class, 'index']);

//Afficher une categorie spécifique
Route::get('articles/{id}', [ArticleController::class, 'show']);

//Ajouter une article
Route::post('articles', [ArticleController::class, 'store']);

//Modifier une article
Route::put('articles/{id}', [ArticleController::class, 'update']);

//Supprimer une article
Route::delete('articles/{id}', [ArticleController::class, 'destroy']);

/**
 *Les routes de Personne
 */

//Eloquent pour avoir la liste de toutes les personnes
Route::get('personne-index', [PersonneController::class, 'index']);

//Eloquent pour avoir la liste des 25 premieres personnes
Route::get('premiers-personne', [PersonneController::class, 'premiers']);

//Eloquent pour avoir la liste des personnes par ordre de id croissant
Route::get('personnes-id-croissant', [PersonneController::class, 'personnesIdCroissant']);

//Eloquent pour avoir la liste des personnes par ordre de id decroissant
Route::get('personnes-id-decroissant', [PersonneController::class, 'personnesIdDecroissant']);

//Eloquent pour avoir la liste des personnes par ordre de age croissant
Route::get('personnes-age-croissant', [PersonneController::class, 'personnesAgeCroissant']);

//Eloquent pour avoir la liste des personnes par ordre de age decroissant
Route::get('personnes-age-decroissant', [PersonneController::class, 'personnesAgeDecroissant']);

////Eloquent pour avoir la liste des personnes dont l'age < 30
Route::get('age-inferieur-trente', [PersonneController::class, 'ageInferieurTrente']);

//Eloquent pour avoir la liste des personnes dont l'age > 30
Route::get('age-superieur-trente', [PersonneController::class, 'ageSuperieurTrente']);

//Eloquent pour avoir la liste des personnes dont l'age < 40
Route::get('age-inferieur-quarante', [PersonneController::class, 'ageInferieurQuarante']);

//Eloquent pour avoir la liste des personnes dont l'age > 40
Route::get('age-superieur-quarante', [PersonneController::class, 'ageSuperieurQuarante']);

//Eloquent pour avoir la liste des personnes dont l'age > 20
Route::get('age-superieur-vingt', [PersonneController::class, 'ageSuperieurVingt']);

//Personne a information contenant une chaine de caratère
Route::get('recherche-info/{info}', [PersonneController::class, 'rechercheInfo']);

//Personne a nom contenant une chaine de caratère
Route::get('recherche-nom/{nom}', [PersonneController::class, 'rechercheNom']);

//Eloquent pour avoir la liste des personnes dont l'age est inferieur à 30 et l' id est superieur à 20
Route::get('personne-id-et-age', [PersonneController::class, 'personneIdEtAge']);

//Eloquent pour avoir la liste des personnes dont l'age est inferieur à 30 ou l' id est superieur à 20
Route::get('personne-id-ou-age', [PersonneController::class, 'personneIdOuAge']);

// requete pour supprimer les personnes dont l'age est supperieur à 30
Route::delete('suppimer-personnes', [PersonneController::class, 'suppimerPersonnes']);

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
