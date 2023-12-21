<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $articles = Article::with("categorie")->get();

            return response()->json($articles, 200);
        } catch (Exception $e) {
            return response()->json([
                "Error" => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->json()->all(), [
                "nom" => "required|unique:articles,nom",
                "contenu" => "required",
                "auteur" => "required|",
            ], [
                "nom.required" => "Le nom est obligatoire",
                "nom.unique" => "Le nom existe déjà",
                "contenu.required" => "Le contenu est obigatoire",
                "auteur.required" => "Le nom de l'auteur est obligatoire",
            ]);

            $validator->validate();
            if (Categorie::where('id', $request->categorie_id)->exists()) {
                $article = Article::create([
                    "categorie_id" => $request->categorie_id,
                    "nom" => $request->nom,
                    "description" => $request->description,
                    "contenu" => $request->contenu,
                    "auteur" => $request->auteur,
                    "tags" => $request->tags,
                ]);
                return response()->json([
                    "article" => $article,
                    "message" => "L'article a été bien ajouté"
                ], 200);
            } else {
                return response()->json([
                    "message" => "Cette categorie n'existe pas"
                ], 500);
            }
        } catch (ValidationException $e) {
            return response()->json($e->validator->errors());
        } catch (Exception $th) {
            return response()->json($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            if (Article::where('id', $id)->exists()) {
                $article = Article::find($id);

                return response()->json($article, 200);
            } else {
                return response()->json([
                    "message" => "Cette article n'existe pas"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "Error" => $e->getMessage()
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->json()->all(), [
                "nom" => "required|unique:articles,nom",
                "contenu" => "required",
                "auteur" => "required|",
            ], [
                "nom.required" => "Le nom est obligatoire",
                "nom.unique" => "Le nom existe déjà",
                "contenu.required" => "Le contenu est obigatoire",
                "auteur.required" => "Le nom de l'auteur est obligatoire",
            ]);

            $validator->validate();

            $article = Article::find($id);

            if (Categorie::where('id', $request->categorie_id)->exists()) {
                $article->update([
                    "categorie_id" => $request->categorie_id,
                    "nom" => $request->nom,
                    "description" => $request->description,
                    "contenu" => $request->contenu,
                    "auteur" => $request->auteur,
                    "tags" => $request->tags,
                ]);

                return response()->json([
                    "article" => $article,
                    "message" => "L'article a été bien mise à jour"
                ], 200);
            } else {
                return response()->json([
                    "message" => "Cette categorie n'existe pas"
                ], 500);
            }
        } catch (ValidationException $e) {
            return response()->json($e->validator->errors());
        } catch (Exception $th) {
            return response()->json($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $message = "";
            $status = 0;
            if (Article::where('id', $id)->exists()) {
                Article::destroy($id);
                return response()->json([
                    "message" => "La catégorie a été bien supprimée"
                ], 200);
            } else {
                return response()->json([
                    "message" => "Cette article n'existe pas"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "Error" => $e->getMessage()
            ]);
        }
    }
}
