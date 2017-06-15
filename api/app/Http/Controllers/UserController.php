<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function create(Request $request){

      $user = new User;

      return response()->json( $user );
    }

    public function index(){

      $users = User::all();

      return response()->json( $users );
    }

    public function show(Request $request, $id){

      $user = User::findOrFail($id);

      return response()->json( $user );
    }

    public function update(Request $request, $id){

      $user = User::findOrFail($id);

      return response()->json( $user );
    }

    public function destroy(Request $request, $id){

      $user = User::findOrFail($id);

      return response()->json( $user );
    }
}
