<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<string>|string|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:cto,default'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'email_confirmation' => ['required', 'string', 'email', 'max:255', 'same:email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
