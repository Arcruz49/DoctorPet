<?php

namespace App\Http\Controllers;
use App\Models\cadUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Index() {
        return view('login.index');
    }

    public function Login(Request $request){
        try{
            $login = $request->login;
            $password = $request->password;

            if (empty($login) || empty($password)) {
                return response()->json([
                'success' => false,
                'message'=> 'Login ou senha não informados'
                ],400);
            }

            $user = cadUsuario::where('login', $login)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não encontrado'
                ], 404);
            }

            if (!Hash::check($password, $user->senha)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Senha incorreta'
                ], 401);
            }

            Auth::login($user);
            return response()->json([
                'success' => true,
            ]);

        }
        catch(\Exception $e){
            return response()->json([
                'success'=> false,
                'message'=> $e->getMessage()
            ]) ;
        }
    }

    public function RegisterUser(Request $request){

        try{
            $usuario = cadUsuario::create([
                'login' => $request->login,
                'senha' => Hash::make($request->senha),
                'nmUsuario' => $request->nome,
                'genero' => strtoupper($request->genero), // M ou F
                'dtCriacao' => now(),
                'cdPerfil' => $request->cdPerfil,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuário registrado com sucesso!',
                // 'usuario' => $usuario
            ], 201);

        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'error: ' . $e->getMessage(),
            ]);
        }
    }

    public function LogOut(){
        Auth::logout();
        return redirect()->route('login');
    }

}
