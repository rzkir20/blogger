<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
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
            return redirect()->route('login');
        }

        $expected = $this->canonicalRole($role);

        if ($user->isSuperAdmin() || $user->normalizedRole() === $expected) {
            return $next($request);
        }

        return redirect()->route($user->dashboardRouteName());
    }

    private function canonicalRole(string $role): string
    {
        $raw = strtolower(trim($role));

        return str_replace(['-', ' '], '_', $raw);
    }
}
