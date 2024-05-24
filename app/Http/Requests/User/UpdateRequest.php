<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var User $authenticated_user */
        $authenticated_user = Auth::user();

        return $authenticated_user->can('update', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<string>|string|ValidationRule>
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:cto,default'],
            'email' => ['required', 'string', 'email', 'max:255', 'confirmed', "unique:users,email,{$user->id}"],
            'email_confirmation' => ['required', 'string', 'email', 'max:255'],
        ];
    }
}
