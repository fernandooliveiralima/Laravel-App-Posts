<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class RegisterUserController extends Controller
{
    public function registerUser()
    {
        return view('auth.register_user');
    }

    public function store(Request $request)
    {   
        // Validate The Request Rules
        $validationRules = [
            'name' => ['required', 'max:255', 'min:5', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed' ,Password::defaults()]
        ];
        
        // Validation Messages
        $validationMessages = [
            'name.required' => 'O nome é obrigatorio, e precisa ter mais de 5 letras.',
            'email.required' => 'Insira um Email válido.',
            'password.required' => 'A senha é obrigatória e deve conter no mínimo 8 caracteres.',
        ];

        $request->validate($validationRules, $validationMessages);
        

        //Create a New User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        // Log The User
        auth()->login($user);
        
        //Redirect To Index Route
        return redirect()->route('posts.index');

    }

}
