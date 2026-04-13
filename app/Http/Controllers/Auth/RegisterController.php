<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use RedirectsAfterAuthentication;

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'bio' => ['nullable', 'string', 'max:10000'],
            'role' => ['required', Rule::in([User::ROLE_READER, User::ROLE_WRITER])],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'bio' => $validated['bio'] ?? null,
            'role' => $validated['role'],
        ]);

        Auth::login($user, remember: true);

        return $this->redirectAfterRegistration(
            $user,
            'Registration complete. Welcome to the archive.',
        );
    }
}
