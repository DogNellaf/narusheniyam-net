<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	private const USER_VALIDATOR = [
		'name' => ['required', 'string', 'max:255'],
		'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
		'phone_number' => ['required', 'string', 'max:12'],
		'firstname' => ['required', 'string'],
		'middlename' => ['required', 'string'],
		'lastname' => ['required', 'string'],
		'password' => ['nullable', 'string', 'min:8', 'confirmed'],
	];

    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index() {
		$violations = Auth::user()->violations()->latest()->get();
		return view('dashboard/index', compact('violations'));
    }

	public function user_info() {
		$user = Auth::user();
		return view('dashboard/user-info', compact('user'));
    }

	public function user_save(Request $request) {
		$user = Auth::user();
		$validated = $request->validate(self::USER_VALIDATOR);
		$user->fill([
			'name' => $validated['name'],
			'email' => $validated['email'],
			'phone_number' => $validated['phone_number'],
			'firstname' => $validated['firstname'],
			'middlename' => $validated['middlename'],
			'lastname' => $validated['lastname'],
			'password' => $validated['password']]);
		$user->save();
		return redirect()->route('user.info', compact('user'));
    }
}
