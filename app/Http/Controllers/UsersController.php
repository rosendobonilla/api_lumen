<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    function usersList(Request $request) {

        //if($request->isJson()){

            $user = User::all();

            return response()->json($user, 200);
        //}

        //return response()->json(['error' => 'No esta autorizado a acceder a estos datos.'], 401,[]);
    }

    function addUser(Request $request){

        //if($request->isJson()){

            $data = $request->json()->all();
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'token' => Str::random(60),
                //'token' => Hash::make(Str::random(60)),
            ]);

            return response()->json($user,201);
        //}

        //return response()->json(['error' => 'No esta autorizado a acceder a estos datos.'], 401,[]);

    }

    function getToken(Request $request){
        //if($request->isJson()) {
            try{
                $data = $request->json()->all();

                $user = User::where('username', $data['username'])->first();

                if($user && Hash::check($data['password'], $user->password)) {
                    //return response()->json(['info' => 'Ingreso correcto'],200);
                    return response()->json($user,200);
                }
                else{
                    return response()->json(['error' => 'No autorizado. Ingrese las credenciales validas para este usuario'],406);
                }
            }
            catch (ModelNotFoundException $e){
                return response()->json(['error' => 'Sin contenido'],406);
            }
        //}
        //return response()->json(['error' => 'No esta autorizado a acceder a estos datos.'], 401,[]);

    }

}
