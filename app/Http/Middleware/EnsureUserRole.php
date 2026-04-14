<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Reader / writer hanya boleh area role mereka; /dashboard khusus super_admin (mereka tidak lolos cek role itu).
     * Super admin boleh masuk /writer dan /reader (bypass).
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /** @var User|null $user */
        $user = $request->user();

        if (! $user) {
            ToastMagic::warning('Harus login dulu', 'Silakan login untuk melanjutkan.');

            return redirect()->route('login');
        }

        $expected = $this->canonicalRole($role);

        if ($user->isSuperAdmin() || $user->normalizedRole() === $expected) {
            return $next($request);
        }

        ToastMagic::error('Akses ditolak', 'Kamu tidak punya izin untuk membuka halaman ini.');

        return redirect()->route($user->dashboardRouteName());
    }

    private function canonicalRole(string $role): string
    {
        $raw = strtolower(trim($role));

        return str_replace(['-', ' '], '_', $raw);
    }
}
