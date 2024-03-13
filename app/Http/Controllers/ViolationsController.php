<?php

namespace App\Http\Controllers;

use App\Models\Violation;

use Illuminate\Support\Facades\Auth;

class ViolationsController extends Controller
{
	private const VIOLATION_VALIDATOR = [
		'description' => ['required'],
		'number' => ['required', 'max:10', 'min:9'],
		'status' => ['required', 'max:13', 'min:5']
	];

	public function detail(Violation $violation) {
		return view('violations/detail', compact('violation'));
	}

	public function edit(Violation $violation) {
		return view('violations/edit', compact('violation'));
	}

	public function update(Request $request, Violation $violation) {
		$validated = $request->validate(self::VIOLATION_VALIDATOR);
		$violation->fill([
					'description' => $validated['description'],
					'number' => $validated['number'],
					'status' => $validated['status']]);
		$violation->save();
		return redirect()->route('home');
	}
	public function create() {
		return view('violations/create');
	}

	public function store(Request $request) {
		Auth::user()->violations()->create([
			  'description' => $request->description,
			  'number' => $request->number,
			  'status' => "Новое"]);
		return redirect()->route('home');
	}
}