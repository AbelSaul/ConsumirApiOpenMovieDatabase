<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
        //Solo dejara pasar a los usuarios autentificados
    }
    public function index(){
        
        $url = "http://www.omdbapi.com/?apikey=16771658&t=shrek";
       

        $options = array(
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => "GET",
        );
    
        $handle = curl_init();
        curl_setopt_array($handle, ($options));
        $response = curl_exec($handle);
        $film=json_decode($response,true);

        return view('dashboard',compact('film'));
    }
}
