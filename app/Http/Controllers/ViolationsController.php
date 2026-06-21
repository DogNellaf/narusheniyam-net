<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ViolationsController extends Controller
{
    private const STATUS_RULES = ['required', 'string', 'in:Новое,Подтверждено,Отклонено'];

    private const STORE_RULES = [
        'description' => ['required', 'string', 'max:2000'],
        'number'      => ['required', 'string', 'min:6', 'max:10'],
    ];

    private const UPDATE_RULES = [
        'description' => ['required', 'string', 'max:2000'],
        'number'      => ['required', 'string', 'min:6', 'max:10'],
        'status'      => ['required', 'string', 'in:Новое,Подтверждено,Отклонено'],
    ];

    public function detail(Violation $violation)
    {
        return view('violations.detail', compact('violation'));
    }

    public function create()
    {
        return view('violations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(self::STORE_RULES);

        Auth::user()->violations()->create([
            'description' => $validated['description'],
            'number'      => $validated['number'],
            'status'      => Violation::STATUS_NEW,
        ]);

        return redirect()->route('home')->with('success', 'Заявление успешно добавлено.');
    }

    public function edit(Violation $violation)
    {
        return view('violations.edit', compact('violation'));
    }

    public function update(Request $request, Violation $violation)
    {
        $validated = $request->validate(self::UPDATE_RULES);

        $violation->update($validated);

        return redirect()->route('home')->with('success', 'Заявление обновлено.');
    }

    public function destroy(Violation $violation)
    {
        $violation->delete();

        return redirect()->route('home')->with('success', 'Заявление удалено.');
    }
}
