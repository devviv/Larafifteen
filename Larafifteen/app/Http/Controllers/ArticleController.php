<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with("categorie")->get();

        return response()->json($articles, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Article::where('id', $id)->exists()) {
            $article = Article::find($id);

            return response()->json($article, 200);
        } else {
            return response()->json([
                "message" => "Cette article n'existe pas"
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = "";
        $status = 0;
        if (Article::where('id', $id)->exists()) {
            Article::destroy($id);
            $message = "La catégorie a été bien supprimée";
            $status = 200;
        } else {
            $message = "Cette article n'existe pas";
            $status = 500;
        }

        
    }
}
