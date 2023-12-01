<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    // Tableau de produit

    public $produits = ["Cahier", "Bic", "Livre", "Crayon", "Règle"];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->produits;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $resquest)
    {

        array_push($this->produits, $resquest->json("produitNom"));

        return $this->produits;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        if(isset($this->produits[$id])){

            return $this->produits[$id];
        }
        else{
            return "Erreur: position invalide";
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(isset($this->produits[$id])){
            $this->produits[$id] = $request->json("nouveauProduit");

            return $this->produits;
        }
        else{
            return "Erreur: position invalide";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $this->produits = [];

        return $this->produits;
    }
}
