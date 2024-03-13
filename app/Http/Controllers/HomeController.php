<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Violation;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index() {
		$violations = Auth::user()->violations()->latest()->get();
		return view('dashboard/index', compact('violations'));
    }

	public function user_data() {
		$user = Auth::user();
		return view('dashboard/index', compact('user'));
    }
}
