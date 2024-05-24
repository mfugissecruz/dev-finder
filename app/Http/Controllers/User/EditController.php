<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class EditController extends Controller
{
    public function edit(User $user): View
    {
        Gate::authorize('update', $user);

        return view('user.edit', compact('user'));
    }

    public function update(User $user, UpdateRequest $request): RedirectResponse
    {
        /** @var User $authenticated_user */
        $authenticated_user = Auth::user();

        if ($authenticated_user->is($user)) {
            $request->session()->flash('error', 'You cannot update yourself!');

            return Redirect::route('user.index');
        }

        $request->validated();

        $user->update([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
        ]);

        return Redirect::route('user.index')
            ->with('success', 'User updated successfully!');
    }
}
