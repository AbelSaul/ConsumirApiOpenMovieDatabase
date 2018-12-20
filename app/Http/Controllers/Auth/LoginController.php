<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ServiceSuscriptions;

use Auth;
use DateTime;

class LoginController extends Controller
{

    public function __construct(){
        $this->middleware('guest',['only' => 'showLoginForm']);
        //Solo pasaran a esta ruta los invitados los no autentificados
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login()
    {
        $credentials = request();

        $serviceSuscriptions = new ServiceSuscriptions($credentials['email'],$credentials['system']);

        if ($serviceSuscriptions->validateUser()) 
        {
            if($serviceSuscriptions->validateSystem()){
                if ($serviceSuscriptions->validateDateSuscription()) { 
                    // return redirect()->route('dashboard');
                    return redirect('/dashboard')->with('success', 'Bienvenido');
                }else{
                    return redirect('/')->with('denied', 'Su suscripcion vencio');
                }
            }else{

                return redirect('/')->with('denied', 'Usted no se encuentra registrado en el sistema: '.$credentials['system']);
            }
        }else{
                return redirect('/')->with('denied', 'Usuario no registrado');
        }

        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function username(){
        return 'name';

        //retun 'name' en este caso el campo name tiene que ser unique y cambiariamos todos los email por name
    }



}
