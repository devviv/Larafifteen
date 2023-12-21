<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    //Eloquent pour avoir la liste de toutes les personnes
    public function index()
    {
        $personnes = Personne::all();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des 25 premieres personnes
    public function premiers()
    {
        $personnes = Personne::take(25)->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes par ordre de id croissant
    public function personnesIdCroissant()
    {
        $personnes = Personne::OrderBy('id', 'asc')->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes par ordre de id decroissant
    public function personnesIdDecroissant()
    {
        $personnes = Personne::OrderBy('id', 'desc')->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes par ordre de age croissant
    public function personnesAgeCroissant()
    {
        $personnes = Personne::OrderBy('age', 'asc')->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes par ordre de age decroissant
    public function personnesAgeDecroissant()
    {
        $personnes = Personne::OrderBy('age', 'desc')->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes dont l'age < 30
    public function ageInferieurTrente()
    {
        $personnes = Personne::where('age', '<', 30)->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes dont l'age > 30
    public function ageSuperieurTrente()
    {
        $personnes = Personne::where('age', '>', 30)->get();
        return response()->json($personnes);
    }
    //Eloquent pour avoir la liste des personnes dont l'age < 40
    public function ageInferieurQuarante()
    {
        $personnes = Personne::where('age', '<', 40)->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes dont l'age > 40
    public function ageSuperieurQuarante()
    {
        $personnes = Personne::where('age', '>', 40)->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes dont l'age > 20
    public function ageSuperieurVingt()
    {
        $personnes = Personne::where('age', '>', 20)->get();
        return response()->json($personnes);
    }

    //Personne a information contenant une chaine de caratère
    public function rechercheInfo($info)
    {
        $personnes = Personne::where('information', 'like', '%' . $info . '%')->get();
        return response()->json($personnes);
    }

    //Personne a nom contenant une chaine de caratère
    public function rechercheNom($nom)
    {
        $personnes = Personne::where('nom', 'like', '%' . $nom . '%')->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes dont l'age est inferieur à 30 et l' id est superieur à 20
    public function personneIdEtAge()
    {
        $personnes = Personne::where('age', '<', 30)->where('id', '>', 20)->get();
        return response()->json($personnes);
    }

    //Eloquent pour avoir la liste des personnes dont l'age est inferieur à 30 ou l' id est superieur à 20
    public function personneIdOuAge()
    {
        $personnes = Personne::where('age', '<', 30)->orwhere('id', '>', 20)->get();
        return response()->json($personnes);
    }

    // requete pour supprimer les personnes dont l'age est supperieur à 30
    public function suppimerPersonnes()
    {
        $personnes = Personne::where('age', '<', 30)->get();
        foreach ($personnes as $personne) {
            $personne->delete();
        }
        return response()->json([
            "message" => "Personnes suprimées"
        ]);
    }
}
