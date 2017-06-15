<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function signin(Request $request){

      $user = User::where([
        'email' => $request->input('email'),
        'password' => $request->input('password')
      ])->firstOrFail();

      $user->api_token = uniqid();
      $user->save();

      if ( $request->input('email') === 'doll1988@yandex.ru'){
        $user['role'] = 'admin';
      }

//      $user = User::first();

      return response()->json( $user );
    }
}
