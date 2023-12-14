<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    //
    public function register(Request $request)
    {
        //Validar los datos

        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);



        // Verificar si el usuario ya está registrado
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // El usuario ya está registrado, puedes manejar esto como desees
            // Por ejemplo, puedes redirigir de nuevo al formulario de registro con un mensaje de error
            return redirect()->back()->with('error', 'El correo electrónico ya está registrado.');
        }


        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Auth::login($user);

        return redirect(route('privada'));
    }


    public function login(Request $request)
    {

        //Validación
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
            //"active" => true
        ];

        $remember = ($request->has('remember') ? true : false);

        if (Auth::attempt($credentials, $remember)) {

            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        } else {
            return redirect('login');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
