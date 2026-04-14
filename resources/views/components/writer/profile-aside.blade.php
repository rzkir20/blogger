@php
    $user = Auth::user();
    $bio = $user->bio ?: 'Cultural critic and writer exploring the intersection of brutalist architecture and digital interface design. Contributor to ARCHIVE since joining the network.';
    $memberSince = $user->created_at?->format('M Y') ?? '—';
@endphp

<div id="profile"
    class="w-full xl:w-80 xl:shrink-0 border-t-2 xl:border-t-0 xl:border-l-2 border-zinc-900 dark:border-zinc-300 bg-white dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50 xl:sticky xl:top-0 xl:max-h-screen xl:overflow-y-auto writer-scroll p-8 space-y-8">
    <div class="space-y-6">
        <h2 class="font-black text-3xl md:text-4xl tracking-tighter border-b border-zinc-900 dark:border-zinc-300 pb-4">Writer Info</h2>

        <div class="w-full aspect-square bg-zinc-950 grayscale relative group overflow-hidden border-2 border-zinc-900 dark:border-zinc-300">
            <iconify-icon icon="lucide:camera"
                class="text-5xl absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 opacity-0 group-hover:opacity-100 transition-opacity text-zinc-50 pointer-events-none"></iconify-icon>
            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&amp;w=600&amp;auto=format&amp;fit=crop"
                alt="Profile" class="w-full h-full object-cover group-hover:opacity-50 transition-opacity">
        </div>

        <div class="space-y-6">
            <div class="space-y-2">
                <span class="block font-mono text-[10px] font-black uppercase tracking-widest opacity-50">Biography</span>
                <p class="text-base leading-relaxed font-semibold">
                    {{ $bio }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 border-t border-zinc-900 dark:border-zinc-300 pt-6">
                <div>
                    <span class="block font-mono text-[10px] font-black uppercase tracking-widest opacity-50 mb-1">Member Since</span>
                    <span class="text-lg font-black uppercase">{{ strtoupper($memberSince) }}</span>
                </div>
                <div>
                    <span class="block font-mono text-[10px] font-black uppercase tracking-widest opacity-50 mb-1">Region</span>
                    <span class="text-lg font-black uppercase">—</span>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <a href="#" class="p-3 border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors" aria-label="Twitter">
                    <iconify-icon icon="lucide:twitter" class="text-lg"></iconify-icon>
                </a>
                <a href="#" class="p-3 border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors" aria-label="Instagram">
                    <iconify-icon icon="lucide:instagram" class="text-lg"></iconify-icon>
                </a>
                <a href="#" class="p-3 border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors" aria-label="Website">
                    <iconify-icon icon="lucide:globe" class="text-lg"></iconify-icon>
                </a>
            </div>

            <a href="{{ route('writer.profile') }}" class="block w-full text-center border-2 border-zinc-900 dark:border-zinc-300 py-4 font-black uppercase hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all text-sm tracking-widest">
                Edit Profile Info
            </a>
        </div>
    </div>

    <div class="pt-12 border-t border-zinc-900 dark:border-zinc-300 space-y-4">
        <h3 class="text-xl font-black uppercase">Quick Settings</h3>
        <div class="space-y-2">
            <div class="flex items-center justify-between py-2 border-b border-zinc-900/10 dark:border-zinc-500/20">
                <span class="text-xs font-bold uppercase">Notifications</span>
                <span class="w-10 h-5 bg-zinc-950 dark:bg-zinc-100 shrink-0" aria-hidden="true"></span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-zinc-900/10 dark:border-zinc-500/20">
                <span class="text-xs font-bold uppercase">Public Profile</span>
                <span class="w-10 h-5 bg-zinc-950 dark:bg-zinc-100 shrink-0" aria-hidden="true"></span>
            </div>
        </div>
    </div>
</div>
