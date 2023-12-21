<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Categorie::with("articles")->get();
            return response()->json($categories, 200);
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
            $validator = Validator::make(
                $request->json()->all(),
                [
                    "nom" => "required|unique:categories,nom|min:3",
                    "description" => "required|min:3|max:255",
                ],
                [
                    "nom.required" => "Le nom est obligatoire",
                    "nom.unique" => "Le nom existe déjà",
                    "nom.min" => "Le nom ne doit pas être moins de 3 caractères",
                    "description.required" => "La description est obligatoire",
                    "description.max" => "Le nom ne doit pas être plus que 255 caractères",
                    "description.min" => "Le nom ne doit pas être moins de 3 caractère",
                ]
            );
            $validator->validate();

            $categorie = Categorie::create([
                "nom" => $request->nom,
                "description" => $request->description
            ]);

            return response()->json([
                "categorie" => $categorie,
                "message" => "La catégorie a été bien ajoutée"
            ], 200);
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
            if (Categorie::where('id', $id)->exists()) {
                $categorie = Categorie::find($id);

                return response()->json($categorie, 200);
            } else {
                return response()->json([
                    "message" => "Cette categorie n'existe pas"
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
            $validator = Validator::make(
                $request->json()->all(),
                [
                    "nom" => "required|unique:categories,nom|min:3",
                    "description" => "required|min:3|max:255",
                ],
                [
                    "nom.required" => "Le nom est obligatoire",
                    "nom.unique" => "Le nom existe déjà",
                    "nom.min" => "Le nom ne doit pas être moins de 3 caractères",
                    "description.required" => "La description est obligatoire",
                    "description.max" => "Le nom ne doit pas être plus que 255 caractères",
                    "description.min" => "Le nom ne doit pas être moins de 3 caractère",
                ]
            );
            $validator->validate();


            $categorie = Categorie::find($id);
            $categorie->update([
                "nom" => $request->nom,
                "description" => $request->description
            ]);

            return response()->json([
                "categorie" => $categorie,
                "message" => "La catégorie a été bien mise à jour"
            ], 200);
        } catch (ValidationException $e) {
            return response()->json($e->validator->errors());
        } catch (Exception $e) {
            return response()->json([
                "Error" => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
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
        } catch (Exception $e) {
            return response()->json([
                "Error" => $e->getMessage()
            ]);
        }
    }
}
