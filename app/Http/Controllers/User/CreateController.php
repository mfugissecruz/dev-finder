<?php

namespace App\Http\Controllers\User;

use App\Helper\ValidateType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class CreateController extends Controller
{
    public function create(): View
    {
        Gate::authorize('create', User::class);

        return view('user.create');
    }
    public function store(StoreRequest $request): RedirectResponse
    {
        $request->validated();
        $password = ValidateType::string($request->input('password'));

        User::query()->create([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'password' => Hash::make($password),
        ]);

        return redirect()->route('user.index')
            ->with('success', 'Usuário criado com sucesso!');
    }
}
