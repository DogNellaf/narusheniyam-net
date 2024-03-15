<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;

use Session;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function customLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home')
                ->withSuccess('Вы были авторизованы');
        }
        return redirect("login")->withSuccess('Данные авторизации неверны');
    }
    public function registration()
    {
        return view('auth.register');
    }
    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = $this->create($data);
        return redirect("home")->withSuccess('Вы были авторизованы');
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return redirect("login")->withSuccess('У вас нет прав');
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
