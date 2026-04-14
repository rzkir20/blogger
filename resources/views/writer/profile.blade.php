@php
    $user = Auth::user();
    $defaultBio = 'Cultural critic and writer exploring the intersection of brutalist architecture and digital interface design. Contributor to ARCHIVE magazine since 2022.';
    $bio = old('bio', $user->bio ?: $defaultBio);
    $bioLength = mb_strlen($bio);
    $memberSince = strtoupper($user->created_at?->format('M Y') ?? '—');
    $avatarUrl = $user->avatar_path
        ? Storage::url($user->avatar_path)
        : 'https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=600&auto=format&fit=crop';
    $region = old('region', $user->region);
    $twitterUrl = old('twitter_url', $user->twitter_url);
    $instagramUrl = old('instagram_url', $user->instagram_url);
    $websiteUrl = old('website_url', $user->website_url);
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

                @if (session('success'))
                    <div class="p-4 brutalist-border bg-green-50 dark:bg-green-950 text-green-900 dark:text-green-100 font-mono text-xs uppercase" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 brutalist-border bg-red-50 dark:bg-red-950 text-red-900 dark:text-red-100 font-mono text-xs uppercase" role="alert">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="writer-profile-form" class="space-y-24" action="{{ route('writer.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <section class="space-y-8">
                        <h2 class="font-black text-2xl md:text-3xl tracking-tighter uppercase">01. Visual Identity</h2>
                        <div class="flex flex-col xl:flex-row items-start gap-12">
                            <div class="w-48 h-48 border-2 border-zinc-900 dark:border-zinc-300 shrink-0 grayscale group relative overflow-hidden">
                                <img id="profile-avatar-preview" src="{{ $avatarUrl }}" data-fallback-avatar-url="{{ $avatarUrl }}" alt="Avatar preview" class="w-full h-full object-cover group-hover:opacity-40 transition-opacity">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                                    <iconify-icon icon="lucide:camera" class="text-3xl text-zinc-950 dark:text-zinc-50"></iconify-icon>
                                </div>
                            </div>
                            <div class="flex-1 space-y-6 w-full min-w-0">
                                <x-ui.file
                                    name="avatar"
                                    id-prefix="profile-avatar"
                                    accept="image/*,.avif"
                                    drop-text="Drop new avatar here or click to browse"
                                    helper-text="Recommended: 1000x1000px JPG/PNG"
                                    upload-button-text="Upload New"
                                    remove-button-text="Remove Current"
                                    remove-field-name="remove_avatar"
                                    empty-file-text="No file selected"
                                    invalid-file-text="Invalid file, please drop an image"
                                />
                            </div>
                        </div>
                    </section>

                    <section class="space-y-8">
                        <h2 class="font-black text-2xl md:text-3xl tracking-tighter uppercase">02. Editorial Dossier</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div class="space-y-6 md:col-span-2">
                                <div>
                                    <x-ui.label for="profile-bio" text="Editorial Biography" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                                    <x-ui.textarea id="profile-bio" name="bio" rows="4" class="brutalist-input w-full dark:bg-transparent">{{ $bio }}</x-ui.textarea>
                                    <p class="font-mono text-[9px] font-black uppercase mt-2 opacity-40">Character limit: {{ $bioLength }} / 500 used.</p>
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <x-ui.label for="profile-email" text="Primary Communication Email" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                                    <x-ui.input id="profile-email" name="email" type="email" :value="old('email', $user->email)" autocomplete="email" class="brutalist-input w-full dark:bg-transparent" required />
                                </div>
                                <div>
                                    <x-ui.label for="profile-region" text="Operational Region" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                                    @php
                                        $regionOptions = [
                                            'Berlin, Germany',
                                            'London, United Kingdom',
                                            'Tokyo, Japan',
                                            'New York, USA',
                                            'Paris, France',
                                            'Amsterdam, Netherlands',
                                            'Madrid, Spain',
                                            'Rome, Italy',
                                            'Istanbul, Turkey',
                                            'Dubai, UAE',
                                            'Mumbai, India',
                                            'Singapore, Singapore',
                                            'Seoul, South Korea',
                                            'Hong Kong, China',
                                            'Sydney, Australia',
                                            'Melbourne, Australia',
                                            'Toronto, Canada',
                                            'Vancouver, Canada',
                                            'Los Angeles, USA',
                                            'Chicago, USA',
                                            'São Paulo, Brazil',
                                            'Mexico City, Mexico',
                                            'Cape Town, South Africa',
                                            'Cairo, Egypt',
                                            'Nairobi, Kenya',
                                            'Jakarta, Indonesia',
                                            'Bandung, Indonesia',
                                            'Surabaya, Indonesia',
                                            'Yogyakarta, Indonesia',
                                        ];
                                    @endphp
                                    <select id="profile-region" name="region" class="brutalist-input h-[54px] w-full appearance-none cursor-pointer dark:bg-transparent">
                                        <x-ui.option value="" label="Select region" :selected="$region === '' || $region === null" />
                                        @foreach ($regionOptions as $regionOption)
                                            <x-ui.option :value="$regionOption" :label="$regionOption" :selected="$region === $regionOption" />
                                        @endforeach
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
                                <x-ui.label for="profile-twitter" text="Twitter / X Profile" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                                <div class="flex">
                                    <div class="w-14 border-2 border-r-0 border-zinc-900 dark:border-zinc-300 flex items-center justify-center bg-zinc-950 dark:bg-zinc-100 text-zinc-50 dark:text-zinc-950 shrink-0">
                                        <iconify-icon icon="lucide:twitter" class="text-xl"></iconify-icon>
                                    </div>
                                    <x-ui.input id="profile-twitter" name="twitter_url" type="text" :value="$twitterUrl" class="brutalist-input flex-1 min-w-0 border-l-0 dark:bg-transparent" autocomplete="url" />
                                </div>
                            </div>
                            <div class="relative">
                                <x-ui.label for="profile-instagram" text="Instagram Grid" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                                <div class="flex">
                                    <div class="w-14 border-2 border-r-0 border-zinc-900 dark:border-zinc-300 flex items-center justify-center bg-zinc-950 dark:bg-zinc-100 text-zinc-50 dark:text-zinc-950 shrink-0">
                                        <iconify-icon icon="lucide:instagram" class="text-xl"></iconify-icon>
                                    </div>
                                    <x-ui.input id="profile-instagram" name="instagram_url" type="text" :value="$instagramUrl" class="brutalist-input flex-1 min-w-0 border-l-0 dark:bg-transparent" autocomplete="url" />
                                </div>
                            </div>
                            <div class="relative md:col-span-2">
                                <x-ui.label for="profile-site" text="Personal Network Site" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                                <div class="flex">
                                    <div class="w-14 border-2 border-r-0 border-zinc-900 dark:border-zinc-300 flex items-center justify-center bg-zinc-950 dark:bg-zinc-100 text-zinc-50 dark:text-zinc-950 shrink-0">
                                        <iconify-icon icon="lucide:globe" class="text-xl"></iconify-icon>
                                    </div>
                                    <x-ui.input id="profile-site" name="website_url" type="text" :value="$websiteUrl" class="brutalist-input flex-1 min-w-0 border-l-0 dark:bg-transparent" autocomplete="url" />
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="pt-12 border-t-2 border-zinc-900 dark:border-zinc-300 flex flex-col md:flex-row gap-6">
                        <x-ui.button id="profile-submit-button" type="submit" class="bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-12 py-5 text-sm font-black uppercase tracking-[0.2em] border-2 border-zinc-900 dark:border-zinc-300 hover:bg-zinc-100 hover:text-zinc-950 dark:hover:bg-zinc-950 dark:hover:text-zinc-50 transition-all shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(212,212,216,1)] active:shadow-none active:translate-x-1 active:translate-y-1 disabled:opacity-70 disabled:cursor-not-allowed">
                            <span id="profile-submit-label">Save Protocol Changes</span>
                            <span id="profile-submit-spinner" class="hidden ml-2">
                                <x-ui.spiner size="xs" label="Saving..." />
                            </span>
                        </x-ui.button>
                        <a href="{{ route('writer.profile') }}" class="inline-flex items-center justify-center border-2 border-zinc-900 dark:border-zinc-300 px-12 py-5 text-sm font-black uppercase tracking-[0.2em] hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-all text-zinc-950 dark:text-zinc-50">
                            Abort Modification
                        </a>
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

</body>
</html>
