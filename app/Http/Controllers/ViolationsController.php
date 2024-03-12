<?php

namespace App\Http\Controllers;

use App\Models\Violation;

use Illuminate\Support\Facades\Auth;

class ViolationsController extends Controller
{
	public function detail(Violation $violation) {
		return view('detail', ['violation' => $violation]);
	}
	public function index() {
		if (Auth::check()) {
			$user = Auth::user();
			if ($user->is_admin) {
				return view('home', ['violations' => Violation::latest()->get()]);
			}
			// Пользователь вошёл в систему...
			return redirect('home');
		}
		return redirect('login');
    }
}
