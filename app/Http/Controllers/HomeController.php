<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Violation;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index() {
		$user = Auth::user();
		if ($user->is_admin) {
			$violations = Violation::latest()->get();
		} else {
			$violations = $user->violations()->latest()->get();
		}
		
		return view('dashboard/index', compact('violations'));
    }

	public function user_info() {
		$user = Auth::user();
		return view('dashboard/user-info', compact('user'));
    }

	public function user_save(Request $request) {
		$user = Auth::user();
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
			'phone_number' => ['required', 'string', 'max:12'],
			'firstname' => ['required', 'string'],
			'middlename' => ['required', 'string'],
			'lastname' => ['required', 'string'],
			'password' => ['nullable', 'string', 'min:8']
		]);
		$user->fill([
			'name' => $validated['name'],
			'email' => $validated['email'],
			'phone_number' => $validated['phone_number'],
			'firstname' => $validated['firstname'],
			'middlename' => $validated['middlename'],
			'lastname' => $validated['lastname']]);
		if ($validated['password'] != null) {
			$user->password = Hash::make($validated['password']);
		}
		$user->save();
		return redirect()->route('user.info', compact('user'));
    }
}
