<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | Brutalist Editorial Blog</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen">
        @include('components.header')

        <main>
            <section class="grid grid-cols-1 lg:grid-cols-12 brutalist-border-b">
                <div class="lg:col-span-7 p-8 lg:p-16 brutalist-border-r">
                    <div class="flex items-center gap-4 mb-8 font-mono text-sm uppercase">
                        <span class="bg-black text-white px-2 py-0.5">Issue 004</span>
                        <span>/</span>
                        <span>Sept 2024</span>
                    </div>
                    <h1 class="font-black text-6xl md:text-8xl lg:text-9xl leading-[0.85] tracking-tighter mb-12 uppercase">
                        Raw <br> Truths.
                    </h1>
                    <p class="text-2xl font-semibold max-w-xl leading-snug mb-12">
                        A critical examination of modern design systems and the death of human imperfection in the digital age.
                    </p>
                    <div class="flex items-center gap-6 font-mono text-xs uppercase">
                        <span>By: Julian Casablancas</span>
                        <a href="#" class="underline font-bold">Read Document</a>
                    </div>
                </div>
                <div class="lg:col-span-5 relative group overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=1440" class="w-full h-full object-cover grayscale brightness-75 transition-transform duration-500 group-hover:scale-105" alt="Cover Image">
                    <div class="absolute bottom-0 left-0 bg-white brutalist-border-r brutalist-border-t p-4 font-mono text-xs uppercase">
                        01. Visual Static / Cover
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 lg:grid-cols-4 brutalist-border-b">
                <div class="p-8 brutalist-border-r flex flex-col justify-between group cursor-pointer hover:bg-black hover:text-white transition-colors">
                    <div>
                        <span class="font-mono text-xs uppercase mb-4 block">Section A</span>
                        <h3 class="font-black text-3xl uppercase tracking-tighter leading-none mb-4">Digital <br> Nihilism</h3>
                    </div>
                    <p class="text-sm leading-tight mb-6">Why minimalist interfaces are stripping away our personality.</p>
                    <span class="font-mono text-xs underline">Access File</span>
                </div>
                <div class="p-8 brutalist-border-r flex flex-col justify-between group cursor-pointer hover:bg-black hover:text-white transition-colors">
                    <div>
                        <span class="font-mono text-xs uppercase mb-4 block">Section B</span>
                        <h3 class="font-black text-3xl uppercase tracking-tighter leading-none mb-4">Type <br> As Image</h3>
                    </div>
                    <p class="text-sm leading-tight mb-6">When words become the only visual element necessary for storytelling.</p>
                    <span class="font-mono text-xs underline">Access File</span>
                </div>
                <div class="p-8 brutalist-border-r flex flex-col justify-between group cursor-pointer hover:bg-black hover:text-white transition-colors">
                    <div>
                        <span class="font-mono text-xs uppercase mb-4 block">Section C</span>
                        <h3 class="font-black text-3xl uppercase tracking-tighter leading-none mb-4">Grid <br> Systems</h3>
                    </div>
                    <p class="text-sm leading-tight mb-6">The math behind the chaos. Understanding strict alignment.</p>
                    <span class="font-mono text-xs underline">Access File</span>
                </div>
                <div class="p-8 flex flex-col justify-between group cursor-pointer hover:bg-black hover:text-white transition-colors">
                    <div>
                        <span class="font-mono text-xs uppercase mb-4 block">Section D</span>
                        <h3 class="font-black text-3xl uppercase tracking-tighter leading-none mb-4">No <br> Borders</h3>
                    </div>
                    <p class="text-sm leading-tight mb-6">Exploring the concept of boundless information flow.</p>
                    <span class="font-mono text-xs underline">Access File</span>
                </div>
            </section>

            <section class="brutalist-border-b">
                <div class="flex items-center px-8 h-16 brutalist-border-b font-mono text-xs uppercase tracking-widest bg-black text-white">
                    Contributors Showcase / Multi-Author Collective
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5">
                    <div class="p-8 brutalist-border-r brutalist-border-b group relative hover:bg-red-600 transition-colors cursor-pointer">
                        <span class="font-mono text-[10px] block mb-2 opacity-60">CONTRIB_01</span>
                        <h4 class="font-black text-2xl uppercase leading-none group-hover:text-white">Elias <br> Thorne</h4>
                        <p class="text-[10px] uppercase font-bold mt-4 tracking-tighter">Technologist</p>
                    </div>
                    <div class="p-8 brutalist-border-r brutalist-border-b group relative hover:bg-red-600 transition-colors cursor-pointer">
                        <span class="font-mono text-[10px] block mb-2 opacity-60">CONTRIB_02</span>
                        <h4 class="font-black text-2xl uppercase leading-none group-hover:text-white">Sarah <br> Jenkins</h4>
                        <p class="text-[10px] uppercase font-bold mt-4 tracking-tighter">Philosophy</p>
                    </div>
                    <div class="p-8 brutalist-border-r brutalist-border-b group relative hover:bg-red-600 transition-colors cursor-pointer">
                        <span class="font-mono text-[10px] block mb-2 opacity-60">CONTRIB_03</span>
                        <h4 class="font-black text-2xl uppercase leading-none group-hover:text-white">Marcus <br> Vane</h4>
                        <p class="text-[10px] uppercase font-bold mt-4 tracking-tighter">Architecture</p>
                    </div>
                    <div class="p-8 brutalist-border-r brutalist-border-b group relative hover:bg-red-600 transition-colors cursor-pointer">
                        <span class="font-mono text-[10px] block mb-2 opacity-60">CONTRIB_04</span>
                        <h4 class="font-black text-2xl uppercase leading-none group-hover:text-white">Elena <br> Kim</h4>
                        <p class="text-[10px] uppercase font-bold mt-4 tracking-tighter">Neuroscience</p>
                    </div>
                    <div class="p-8 brutalist-border-b group relative hover:bg-red-600 transition-colors cursor-pointer">
                        <span class="font-mono text-[10px] block mb-2 opacity-60">CONTRIB_05</span>
                        <h4 class="font-black text-2xl uppercase leading-none group-hover:text-white">Oliver <br> Grant</h4>
                        <p class="text-[10px] uppercase font-bold mt-4 tracking-tighter">Urbanism</p>
                    </div>
                </div>
            </section>

            <section class="p-8 lg:p-16">
                <div class="flex justify-between items-end mb-16">
                    <h2 class="font-black text-6xl md:text-8xl uppercase leading-none tracking-tighter">Latest <br> Transmissions</h2>
                    <div class="font-mono text-xs uppercase underline cursor-pointer">View all files</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-0 border-t-2 border-l-2 border-black">
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all">
                            <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb">
                        </div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_099</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-4 group-hover:text-red-600">Analog fetishism in the age of silicon.</h3>
                        <div class="flex justify-between items-center">
                            <span class="font-mono text-[10px] uppercase">Author: E. Thorne</span>
                            <span class="font-mono text-[10px] uppercase">03.24.24</span>
                        </div>
                    </article>
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all">
                            <img src="https://images.unsplash.com/photo-1493612276216-ee3925520721?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb">
                        </div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_098</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-4 group-hover:text-red-600">Deep work or deep distraction?</h3>
                        <div class="flex justify-between items-center">
                            <span class="font-mono text-[10px] uppercase">Author: M. Vane</span>
                            <span class="font-mono text-[10px] uppercase">03.22.24</span>
                        </div>
                    </article>
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all">
                            <img src="https://images.unsplash.com/photo-1502472091351-80b78d40167c?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb">
                        </div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_097</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-4 group-hover:text-red-600">The return of the concrete grid.</h3>
                        <div class="flex justify-between items-center">
                            <span class="font-mono text-[10px] uppercase">Author: S. Jenkins</span>
                            <span class="font-mono text-[10px] uppercase">03.20.24</span>
                        </div>
                    </article>
                </div>
            </section>
        </main>

        @include('components.footer')
    </div>
</body>
</html>