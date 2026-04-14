@php
    $user = Auth::user();
    $defaultBio = 'Cultural critic and writer exploring the intersection of brutalist architecture and digital interface design. Contributor to ARCHIVE magazine since 2022.';
    $bio = $user->bio ?: $defaultBio;
    $bioLength = mb_strlen($bio);
    $memberSince = strtoupper($user->created_at?->format('M Y') ?? '—');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Identity Control | Writer Dashboard</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen flex flex-col md:flex-row writer-app bg-white dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">
        @include('components.writer.sidebar', ['active' => $activeNav ?? 'profile'])

        <div class="flex flex-1 flex-col xl:flex-row min-w-0">
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-20 relative">
                <section class="space-y-4 border-b-2 border-zinc-900 dark:border-zinc-300 pb-12">
                    <p class="font-mono text-xs uppercase font-black tracking-[0.2em] opacity-60">Account / Identity Control</p>
                    <h1 class="font-black text-5xl sm:text-6xl lg:text-8xl leading-[0.85] tracking-tighter uppercase">
                        Profile<br>Settings.
                    </h1>
                    <p class="max-w-xl font-bold uppercase text-sm leading-relaxed opacity-70 mt-6">
                        Manage your digital presence, editorial bio, and public-facing credentials. All changes are immediate upon archival.
                    </p>
                </section>

                <form class="space-y-24" action="#" method="post" onsubmit="return false;">
                    @csrf

                    <section class="space-y-8">
                        <h2 class="font-black text-2xl md:text-3xl tracking-tighter uppercase">01. Visual Identity</h2>
                        <div class="flex flex-col xl:flex-row items-start gap-12">
                            <div class="w-48 h-48 border-2 border-zinc-900 dark:border-zinc-300 shrink-0 grayscale group relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&amp;w=600&amp;auto=format&amp;fit=crop" alt="Avatar preview" class="w-full h-full object-cover group-hover:opacity-40 transition-opacity">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                                    <iconify-icon icon="lucide:camera" class="text-3xl text-zinc-950 dark:text-zinc-50"></iconify-icon>
                                </div>
                            </div>
                            <div class="flex-1 space-y-6 w-full min-w-0">
                                <div class="p-12 border-2 border-dashed border-zinc-900 dark:border-zinc-300 flex flex-col items-center justify-center space-y-4 hover:bg-gray-50 dark:hover:bg-zinc-900 transition-colors cursor-pointer">
                                    <iconify-icon icon="lucide:upload-cloud" class="text-4xl text-zinc-950 dark:text-zinc-50"></iconify-icon>
                                    <p class="font-mono text-xs font-black uppercase tracking-widest text-center">Drop new avatar here or click to browse</p>
                                    <p class="font-mono text-[10px] font-bold opacity-40 uppercase">Recommended: 1000x1000px JPG/PNG</p>
                                </div>
                                <div class="flex flex-wrap gap-4">
                                    <button type="button" class="bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-8 py-3 font-mono text-xs font-black uppercase tracking-widest hover:bg-zinc-100 hover:text-zinc-950 dark:hover:bg-zinc-950 dark:hover:text-zinc-50 border-2 border-zinc-900 dark:border-zinc-300 transition-all">Upload New</button>
                                    <button type="button" class="border-2 border-zinc-900 dark:border-zinc-300 px-8 py-3 font-mono text-xs font-black uppercase tracking-widest hover:bg-red-500 hover:text-white hover:border-red-500 transition-all text-zinc-950 dark:text-zinc-50">Remove Current</button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="space-y-8">
                        <h2 class="font-black text-2xl md:text-3xl tracking-tighter uppercase">02. Editorial Dossier</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div class="space-y-6 md:col-span-2">
                                <div>
                                    <label class="brutalist-label font-mono text-zinc-950 dark:text-zinc-50" for="profile-bio">Editorial Biography</label>
                                    <textarea id="profile-bio" name="bio" rows="4" class="brutalist-input resize-none w-full dark:bg-transparent">{{ $bio }}</textarea>
                                    <p class="font-mono text-[9px] font-black uppercase mt-2 opacity-40">Character limit: {{ $bioLength }} / 500 used.</p>
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <label class="brutalist-label font-mono text-zinc-950 dark:text-zinc-50" for="profile-email">Primary Communication Email</label>
                                    <input id="profile-email" name="email" type="email" value="{{ $user->email }}" autocomplete="email" class="brutalist-input w-full dark:bg-transparent">
                                </div>
                                <div>
                                    <label class="brutalist-label font-mono text-zinc-950 dark:text-zinc-50" for="profile-region">Operational Region</label>
                                    <select id="profile-region" name="region" class="brutalist-input h-[54px] w-full appearance-none cursor-pointer dark:bg-transparent">
                                        <option>Berlin, Germany</option>
                                        <option>London, United Kingdom</option>
                                        <option>Tokyo, Japan</option>
                                        <option>New York, USA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="p-6 border-2 border-zinc-900 dark:border-zinc-300 bg-gray-50 dark:bg-zinc-900/50">
                                    <span class="brutalist-label font-mono text-zinc-950 dark:text-zinc-50">Archival Information</span>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="font-mono text-[9px] font-black uppercase opacity-40">Member Since</p>
                                            <p class="text-base font-black uppercase mt-1">{{ $memberSince }}</p>
                                        </div>
                                        <div>
                                            <p class="font-mono text-[9px] font-black uppercase opacity-40">Account Status</p>
                                            <p class="text-base font-black uppercase mt-1 text-green-600 dark:text-green-400">Verified</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="space-y-8">
                        <h2 class="font-black text-2xl md:text-3xl tracking-tighter uppercase">03. External Protocols</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="relative">
                                <label class="brutalist-label font-mono text-zinc-950 dark:text-zinc-50" for="profile-twitter">Twitter / X Profile</label>
                                <div class="flex">
                                    <div class="w-14 border-2 border-r-0 border-zinc-900 dark:border-zinc-300 flex items-center justify-center bg-zinc-950 dark:bg-zinc-100 text-zinc-50 dark:text-zinc-950 shrink-0">
                                        <iconify-icon icon="lucide:twitter" class="text-xl"></iconify-icon>
                                    </div>
                                    <input id="profile-twitter" type="text" value="https://x.com/julian_archive" class="brutalist-input flex-1 min-w-0 border-l-0 dark:bg-transparent" autocomplete="url">
                                </div>
                            </div>
                            <div class="relative">
                                <label class="brutalist-label font-mono text-zinc-950 dark:text-zinc-50" for="profile-instagram">Instagram Grid</label>
                                <div class="flex">
                                    <div class="w-14 border-2 border-r-0 border-zinc-900 dark:border-zinc-300 flex items-center justify-center bg-zinc-950 dark:bg-zinc-100 text-zinc-50 dark:text-zinc-950 shrink-0">
                                        <iconify-icon icon="lucide:instagram" class="text-xl"></iconify-icon>
                                    </div>
                                    <input id="profile-instagram" type="text" value="https://instagram.com/julian_archive" class="brutalist-input flex-1 min-w-0 border-l-0 dark:bg-transparent" autocomplete="url">
                                </div>
                            </div>
                            <div class="relative md:col-span-2">
                                <label class="brutalist-label font-mono text-zinc-950 dark:text-zinc-50" for="profile-site">Personal Network Site</label>
                                <div class="flex">
                                    <div class="w-14 border-2 border-r-0 border-zinc-900 dark:border-zinc-300 flex items-center justify-center bg-zinc-950 dark:bg-zinc-100 text-zinc-50 dark:text-zinc-950 shrink-0">
                                        <iconify-icon icon="lucide:globe" class="text-xl"></iconify-icon>
                                    </div>
                                    <input id="profile-site" type="text" value="https://julian.archive.com" class="brutalist-input flex-1 min-w-0 border-l-0 dark:bg-transparent" autocomplete="url">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="pt-12 border-t-2 border-zinc-900 dark:border-zinc-300 flex flex-col md:flex-row gap-6">
                        <button type="submit" class="bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-12 py-5 text-sm font-black uppercase tracking-[0.2em] border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-100 hover:text-zinc-950 dark:hover:bg-zinc-950 dark:hover:text-zinc-50 transition-all shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(212,212,216,1)] active:shadow-none active:translate-x-1 active:translate-y-1">
                            Save Protocol Changes
                        </button>
                        <button type="button" class="border-2 border-zinc-900 dark:border-zinc-300 px-12 py-5 text-sm font-black uppercase tracking-[0.2em] hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all text-zinc-950 dark:text-zinc-50">
                            Abort Modification
                        </button>
                    </section>
                </form>

                <footer class="pt-24 pb-12">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 border-t border-zinc-900 dark:border-zinc-300 pt-12">
                        <div>
                            <span class="text-2xl font-black tracking-tighter uppercase">Writer. System</span>
                            <p class="font-mono text-[10px] font-black uppercase mt-2 opacity-60 tracking-widest">© {{ date('Y') }} Archive Editorial Group. User_001 Identity File.</p>
                        </div>
                        <div class="flex flex-wrap gap-8">
                            <a href="#" id="footer-support-link" class="font-mono text-[10px] font-black uppercase underline">Network Support</a>
                            <a href="#" id="footer-security-link" class="font-mono text-[10px] font-black uppercase underline">Data Protocol</a>
                        </div>
                    </div>
                </footer>
            </main>

            @include('components.writer.profile-aside')
        </div>
    </div>

    <script>
        (function () {
            const root = document.getElementById('root');
            const btn = document.getElementById('writer-mode-toggle');
            if (btn && root) {
                btn.addEventListener('click', function () {
                    document.body.classList.toggle('dark-mode');
                    root.classList.toggle('dark-mode');
                });
            }
        })();
    </script>
</body>
</html>
