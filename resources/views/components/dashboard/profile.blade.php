@php
    $user = Auth::user();
@endphp

<aside class="hidden lg:flex w-80 border-l-2 border-zinc-900 dark:border-zinc-300 h-screen sticky top-0 p-8 flex-col bg-white dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">
    <div class="mb-8">
        <p class="font-mono text-[10px] uppercase opacity-50">Command Deck</p>
        <h2 class="font-black text-3xl uppercase tracking-tight mt-2">Profile.</h2>
    </div>

    <div class="space-y-4">
        <div class="w-20 h-20 bg-zinc-950 dark:bg-zinc-100 flex items-center justify-center text-zinc-50 dark:text-zinc-950">
            <iconify-icon icon="lucide:shield" class="text-4xl"></iconify-icon>
        </div>
        <p class="font-black text-xl uppercase wrap-break-word">{{ $user->name }}</p>
        <p class="font-mono text-xs uppercase opacity-60 break-all">{{ $user->email }}</p>
    </div>

    <div class="mt-8 space-y-2 font-mono text-[10px] uppercase opacity-70">
        <p>Node status: active</p>
        <p>Access level: super admin</p>
    </div>

    <div class="mt-auto pt-8 border-t border-zinc-900 dark:border-zinc-300 space-y-2 text-xs uppercase font-black">
        <a href="{{ url('/writer') }}" class="block underline hover:no-underline">Open Writer Node</a>
        <a href="{{ url('/reader') }}" class="block underline hover:no-underline">Open Reader Node</a>
    </div>
</aside>
