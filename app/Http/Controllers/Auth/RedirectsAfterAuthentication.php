<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait RedirectsAfterAuthentication
{
    /**
     * Super admin: selalu ke dashboard; `url.intended` diabaikan (sering berisi /reader atau /writer).
     * Role lain: hormati intended URL, fallback ke home role.
     */
    protected function redirectAfterLogin(Request $request, User $user, string $status): RedirectResponse
    {
        ToastMagic::success('Login berhasil', $status);

        if ($user->isSuperAdmin()) {
            $request->session()->forget('url.intended');

            return redirect()->route('dashboard')->with('status', $status);
        }

        return redirect()
            ->intended(route($user->dashboardRouteName()))
            ->with('status', $status);
    }

    /**
     * Setelah daftar tidak memakai intended URL (session bisa dari kunjungan halaman lain).
     */
    protected function redirectAfterRegistration(User $user, string $status): RedirectResponse
    {
        ToastMagic::success('Registrasi berhasil', $status);

        return redirect()
            ->route($user->dashboardRouteName())
            ->with('status', $status);
    }
}
