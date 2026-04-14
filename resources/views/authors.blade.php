<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | Contributors Directory</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen">
        @include('components.header')

        <main>
            <section class="p-8 lg:p-16 brutalist-border-b">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8">
                    <div class="max-w-4xl">
                        <span class="font-mono text-xs uppercase tracking-widest mb-4 block">Registry / Protocol_003</span>
                        <h1 class="font-black text-7xl md:text-8xl lg:text-9xl uppercase tracking-tighter leading-[0.85] mb-4">
                            The <br> Collect- <br> ive.
                        </h1>
                    </div>
                    <div class="w-full lg:w-96 space-y-6">
                        <p class="text-xl font-bold uppercase leading-tight">
                            Meet the architects of visual dissent. A global network of thinkers, makers, and critics.
                        </p>
                        <div class="flex gap-4 font-mono text-[10px] uppercase">
                            <span class="bg-black text-white px-2 py-1">Total: {{ $writers->count() }}_Nodes</span>
                            <span>Status: Active</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 lg:grid-cols-12 brutalist-border-b">
                <div class="lg:col-span-3 p-8 brutalist-border-r">
                    <h3 class="font-mono text-xs uppercase mb-8 opacity-40">Filter_By_Discipline</h3>
                    <ul class="space-y-4 font-black text-2xl uppercase tracking-tighter">
                        <li><a href="#" id="filter-all" class="accent-red">All_Contributors</a></li>
                        <li><a href="#" id="filter-tech" class="hover:accent-red transition-colors">Technologists</a></li>
                        <li><a href="#" id="filter-phil" class="hover:accent-red transition-colors">Philosophers</a></li>
                        <li><a href="#" id="filter-arch" class="hover:accent-red transition-colors">Architects</a></li>
                        <li><a href="#" id="filter-urban" class="hover:accent-red transition-colors">Urbanists</a></li>
                        <li><a href="#" id="filter-crit" class="hover:accent-red transition-colors">Visual_Critics</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-9 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @forelse ($writers as $writer)
                        <a href="{{ route('authors.show', $writer) }}" class="block p-8 brutalist-border-r brutalist-border-b group author-card-hover cursor-pointer">
                            <div class="flex justify-between items-start mb-6">
                                <span class="font-mono text-[10px] uppercase opacity-60">Node_{{ str_pad((string) $writer->id, 3, '0', STR_PAD_LEFT) }}</span>
                                <span class="font-mono text-[10px] uppercase bg-black text-white px-2">{{ str_replace('_', ' ', strtoupper((string) $writer->role)) }}</span>
                            </div>
                            <div class="aspect-square brutalist-border mb-6 grayscale overflow-hidden">
                                <img src="{{ $writer->avatar_path ? asset('storage/'.$writer->avatar_path) : 'https://api.dicebear.com/7.x/avataaars/svg?seed='.urlencode($writer->name) }}" class="w-full h-full object-cover bg-slate-100" alt="{{ $writer->name }}">
                            </div>
                            <h4 class="font-black text-3xl uppercase leading-none mb-2">{{ $writer->name }}</h4>
                            <p class="font-mono text-[10px] uppercase mb-6 opacity-60">Discipline: {{ str_replace('_', ' ', strtoupper((string) $writer->role)) }}</p>
                            <p class="text-sm font-semibold mb-8 line-clamp-3">{{ $writer->bio ?: 'No bio provided yet.' }}</p>
                            <div class="flex justify-between items-end border-t border-black pt-4">
                                <span class="font-mono text-[10px] uppercase">Files: {{ number_format($writer->posts_count) }}</span>
                                <iconify-icon icon="lucide:arrow-right-circle" class="text-2xl"></iconify-icon>
                            </div>
                        </a>
                    @empty
                        <div class="md:col-span-2 lg:col-span-3 p-6">
                            <x-ui.empaty
                                title="Belum ada writer"
                                message="Saat ini belum ada user dengan role writer."
                            />
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="p-8 lg:p-16">
                <div class="brutalist-border p-12 bg-black text-white flex flex-col lg:flex-row gap-12 items-center justify-between">
                    <div class="max-w-xl">
                        <h2 class="font-black text-5xl uppercase tracking-tighter leading-none mb-6">Join the <br> Node Registry.</h2>
                        <p class="font-mono text-sm uppercase">We are always looking for contributors who prioritize raw truth over visual comfort. Submit your portfolio for review.</p>
                    </div>
                    <a href="#" id="apply-cta" class="w-full lg:w-auto px-16 py-8 bg-white text-black font-black uppercase text-2xl tracking-tighter hover:bg-red-600 hover:text-white transition-colors text-center">
                        Apply_Node_Access
                    </a>
                </div>
            </section>
        </main>

        @include('components.footer')
    </div>
</body>
</html>
