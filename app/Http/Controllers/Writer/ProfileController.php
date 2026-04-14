<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('writer.profile', [
            'activeNav' => 'profile',
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate(
            [
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
                'bio' => ['nullable', 'string', 'max:500'],
                'region' => ['nullable', 'string', 'max:120'],
                'twitter_url' => ['nullable', 'string', 'max:255'],
                'instagram_url' => ['nullable', 'string', 'max:255'],
                'website_url' => ['nullable', 'string', 'max:255'],
                'avatar' => ['nullable', 'file', 'mimetypes:image/jpeg,image/png,image/gif,image/webp,image/avif', 'max:3072'],
                'remove_avatar' => ['nullable', 'boolean'],
            ],
            [
                'avatar.file' => 'Avatar tidak terbaca sebagai file upload.',
                'avatar.mimetypes' => 'Format avatar harus jpg, jpeg, png, gif, webp, atau avif.',
                'avatar.max' => 'Ukuran avatar maksimal 3MB.',
            ]
        );

        if ($request->boolean('remove_avatar') && filled($user->avatar_path)) {
            Storage::disk('public')->delete($user->avatar_path);
            $validated['avatar_path'] = null;
        }

        if ($request->hasFile('avatar')) {
            if (filled($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $validated['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        unset($validated['avatar'], $validated['remove_avatar']);

        $user->update($validated);

        ToastMagic::success('Profile berhasil diupdate', 'Perubahan profil kamu sudah disimpan.');

        return redirect()->route('writer.profile');
    }
}
