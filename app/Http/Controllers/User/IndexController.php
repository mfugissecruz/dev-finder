<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        return view('user.index')
            ->with('users', User::query()->latest()->paginate());
    }
}
