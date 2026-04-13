<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | Search Results</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen">
        @include('components.header')

        <main class="grid grid-cols-1 lg:grid-cols-12">
            <aside class="lg:col-span-3 brutalist-border-r min-h-screen">
                <div class="p-8 space-y-12">
                    <div class="font-mono text-xs uppercase bg-black text-white p-2 mb-8 tracking-widest">filter_parameters.exe</div>

                    <section class="space-y-6">
                        <h3 class="font-black text-xl uppercase tracking-tighter border-b-2 border-black pb-2">Categories</h3>
                        <div class="space-y-3 font-mono text-xs uppercase">
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox" checked> <span>Digital_Nihilism</span></label>
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox"> <span>Visual_Tactility</span></label>
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox"> <span>Architecture_Raw</span></label>
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox" checked> <span>Design_Systems</span></label>
                        </div>
                    </section>

                    <section class="space-y-6">
                        <h3 class="font-black text-xl uppercase tracking-tighter border-b-2 border-black pb-2">Authors</h3>
                        <div class="space-y-3 font-mono text-xs uppercase">
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox" checked> <span>J. Casablancas</span></label>
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox"> <span>Elias Thorne</span></label>
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox"> <span>Marcus Vane</span></label>
                        </div>
                    </section>

                    <section class="space-y-6">
                        <h3 class="font-black text-xl uppercase tracking-tighter border-b-2 border-black pb-2">Read_Time</h3>
                        <div class="space-y-3 font-mono text-xs uppercase">
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox"> <span>&lt; 5_Min</span></label>
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox" checked> <span>5-15_Min</span></label>
                            <label class="flex items-center gap-3 cursor-pointer"><input type="checkbox" class="custom-checkbox"> <span>&gt; 15_Min</span></label>
                        </div>
                    </section>

                    <div class="pt-8">
                        <button id="reset-filters" class="w-full py-4 brutalist-border font-black uppercase text-xs hover-red" type="button">Reset_Filters</button>
                    </div>
                </div>
            </aside>

            <section class="lg:col-span-9 p-8 lg:p-12">
                <div class="mb-12 space-y-6">
                    <div class="flex justify-between items-end border-b-4 border-black pb-6">
                        <h1 class="font-black text-5xl lg:text-7xl uppercase tracking-tighter leading-none">
                            Search <br> Results.
                        </h1>
                        <div class="text-right">
                            <span class="font-mono text-xs uppercase block mb-1 opacity-60">QUERY_STATUS</span>
                            <span class="font-mono text-sm uppercase font-bold">MATCH_FOUND: 12 / TOTAL_ARCHIVE</span>
                        </div>
                    </div>
                    <div class="relative flex brutalist-border-4 bg-white">
                        <input type="text" value="Minimalism" class="flex-1 p-6 font-mono text-xl uppercase outline-none bg-transparent" placeholder="START_TYPING...">
                        <button class="p-6 brutalist-border-l hover-red transition-all flex items-center justify-center" type="button">
                            <iconify-icon icon="lucide:search" class="text-3xl"></iconify-icon>
                        </button>
                    </div>
                    <div class="flex gap-4 font-mono text-[10px] uppercase opacity-60">
                        <span>SORT_BY:</span>
                        <a href="#" class="underline font-bold text-black">LATEST_ENTRY</a>
                        <a href="#" class="hover:text-black">MOST_RELEVANT</a>
                        <a href="#" class="hover:text-black">ALPHABETICAL</a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-0 border-t-2 border-l-2 border-black">
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden brutalist-border"><img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb"></div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_099</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600">The Silent Architecture of Digital Minimalism.</h3>
                        <div class="flex justify-between items-center"><span class="font-mono text-[10px] uppercase">Author: J. Casablancas</span><span class="font-mono text-[10px] uppercase">03.24.24</span></div>
                    </article>
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden brutalist-border"><img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb"></div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_092</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-6">Minimalism in Grid Construction.</h3>
                        <div class="flex justify-between items-center"><span class="font-mono text-[10px] uppercase">Author: E. Thorne</span><span class="font-mono text-[10px] uppercase">03.12.24</span></div>
                    </article>
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden brutalist-border"><img src="https://images.unsplash.com/photo-1493612276216-ee3925520721?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb"></div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_088</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-6">Deep Focus vs Modern Clutter.</h3>
                        <div class="flex justify-between items-center"><span class="font-mono text-[10px] uppercase">Author: M. Vane</span><span class="font-mono text-[10px] uppercase">02.28.24</span></div>
                    </article>
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden brutalist-border"><img src="https://images.unsplash.com/photo-1502472091351-80b78d40167c?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb"></div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_074</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-6">When White Space Becomes The Image.</h3>
                        <div class="flex justify-between items-center"><span class="font-mono text-[10px] uppercase">Author: J. Casablancas</span><span class="font-mono text-[10px] uppercase">01.15.24</span></div>
                    </article>
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden brutalist-border"><img src="https://images.unsplash.com/photo-1490122417551-6ee9691429d0?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb"></div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_061</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-6">Functional Minimalism in Home Labs.</h3>
                        <div class="flex justify-between items-center"><span class="font-mono text-[10px] uppercase">Author: E. Thorne</span><span class="font-mono text-[10px] uppercase">12.04.23</span></div>
                    </article>
                    <article class="p-8 border-r-2 border-b-2 border-black group cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors">
                        <div class="aspect-video bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden brutalist-border"><img src="https://images.unsplash.com/photo-1472289065668-ce650ac443d2?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="Thumb"></div>
                        <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_045</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-6">The Decay of Minimalist UI.</h3>
                        <div class="flex justify-between items-center"><span class="font-mono text-[10px] uppercase">Author: M. Vane</span><span class="font-mono text-[10px] uppercase">11.12.23</span></div>
                    </article>
                </div>

                <div class="mt-16 text-center">
                    <button class="px-12 py-5 brutalist-border font-black uppercase text-sm hover-red transition-all" type="button">Load_More_Results</button>
                </div>
            </section>
        </main>

        <footer class="bg-black text-white p-8 lg:p-16 border-t-8 border-black">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-6">
                    <h2 class="font-black text-7xl lg:text-9xl uppercase leading-[0.8] tracking-tighter mb-8">Subscribe <br> or Die.</h2>
                    <p class="font-mono text-sm max-w-md uppercase mb-8">Join the network. Get the raw data. No marketing fluff. Just editorial integrity delivered to your inbox weekly.</p>
                    <form class="flex border-2 border-white">
                        <input type="email" placeholder="ENTER_EMAIL_HERE" class="flex-1 bg-transparent p-4 font-mono text-sm focus:outline-none">
                        <button class="px-8 bg-white text-black font-black uppercase hover:bg-red-600 hover:text-white transition-colors" type="submit">Connect</button>
                    </form>
                </div>
                <div class="lg:col-span-3 lg:border-l border-white/20 lg:pl-12">
                    <h4 class="font-mono text-xs uppercase mb-8 opacity-40">Navigation</h4>
                    <ul class="space-y-4 font-black text-2xl uppercase tracking-tighter">
                        <li><a href="{{ url('/') }}" id="f-home" class="hover:text-red-600 transition-colors">Index</a></li>
                        <li><a href="{{ url('/authors') }}" id="f-authors" class="hover:text-red-600 transition-colors">Contributors</a></li>
                        <li><a href="{{ url('/manifesto') }}" id="f-manifesto" class="hover:text-red-600 transition-colors">Manifesto</a></li>
                        <li><a href="#" id="f-legal" class="hover:text-red-600 transition-colors">Protocols</a></li>
                    </ul>
                </div>
                <div class="lg:col-span-3 lg:border-l border-white/20 lg:pl-12">
                    <h4 class="font-mono text-xs uppercase mb-8 opacity-40">Social Protocols</h4>
                    <ul class="space-y-4 font-black text-2xl uppercase tracking-tighter">
                        <li><a href="#" id="f-twt" class="hover:text-red-600 transition-colors">Twitter</a></li>
                        <li><a href="#" id="f-inst" class="hover:text-red-600 transition-colors">Instagram</a></li>
                        <li><a href="#" id="f-git" class="hover:text-red-600 transition-colors">Github</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-32 pt-8 border-t border-white/20 flex justify-between items-center font-mono text-[10px] uppercase">
                <span>Archive Editorial (c) {{ date('Y') }} / Node_v1.0.1</span>
                <div class="flex gap-8">
                    <a href="#" id="footer-privacy">Privacy_Policy</a>
                    <a href="#" id="footer-terms">Term_Conditions</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
