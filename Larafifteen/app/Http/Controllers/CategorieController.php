<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return response()->json($categories, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categorie = Categorie::create([
            "nom" => $request->nom,
            "description" => $request->description
        ]);

        return response()->json([
            "categorie" => $categorie,
            "message" => "La catégorie a été bien ajouté"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {


        if (Categorie::where('id', $id)->exists()) {
            $categorie = Categorie::find($id);

            return response()->json($categorie, 200);
        } else {
            return response()->json([
                "message" => "Cette categorie n'existe pas"
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        $categorie->update([
            "nom" => $request->nom,
            "description" => $request->description
        ]);

        return response()->json([
            "categorie" => $categorie,
            "message" => "La catégorie a été bien mise à jour"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Categorie::where('id', $id)->exists()) {
            Categorie::destroy($id);

            return response()->json([
                "message" => "La catégorie a été bien supprimée"
            ], 200);
        } else {
            return response()->json([
                "message" => "Cette catégorie n'existe pas"
            ], 500);
        }
    }
}
