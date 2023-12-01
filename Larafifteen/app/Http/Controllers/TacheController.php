<?php

use App\Http\Controllers\Controller;

class TacheController extends Controller{

     public function index() : String {
        return "Je suis index";
    }
    public function show() : String {
        return "Je suis show";
    }
}
?>
