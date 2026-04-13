<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | Category Archive - All Transmissions</title>
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
            <section class="brutalist-border-b p-8 lg:p-16">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 mb-16">
                    <div>
                        <div class="font-mono text-xs uppercase tracking-widest mb-4">Protocol_002 / The_Directory</div>
                        <h1 class="font-black text-6xl md:text-8xl lg:text-9xl leading-[0.8] tracking-tighter uppercase">
                            The <br> Archive.
                        </h1>
                    </div>
                    <div class="lg:max-w-md">
                        <p class="text-lg font-bold uppercase tracking-tight leading-tight mb-8">
                            Complete classification of digital transmissions. Filtered by editorial protocol. No exceptions.
                        </p>
                        <div class="flex items-center gap-4 font-mono text-[10px] uppercase">
                            <span>Total_Files: 142</span>
                            <span>/</span>
                            <span class="accent-red">Active_Issue: 004</span>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-5 border-2 border-black">
                    <button class="p-6 font-black uppercase text-sm brutalist-border-r bg-black text-white hover:bg-red-600" type="button">All_Nodes</button>
                    <button class="p-6 font-black uppercase text-sm brutalist-border-r hover-red" type="button">Design_Theory</button>
                    <button class="p-6 font-black uppercase text-sm brutalist-border-r hover-red" type="button">Philosophy</button>
                    <button class="p-6 font-black uppercase text-sm brutalist-border-r hover-red" type="button">Architecture</button>
                    <button class="p-6 font-black uppercase text-sm hover-red" type="button">Urbanism</button>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0">
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1558655146-d09347e92766?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_104 / Urbanism</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">The metabolism of smart cities.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: O. Grant</span>
                        <span class="font-mono text-[10px] uppercase">03.24.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_103 / Theory</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Post-human UI interfaces.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: E. Thorne</span>
                        <span class="font-mono text-[10px] uppercase">03.23.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1502472091351-80b78d40167c?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_102 / Arch</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">The return of the concrete grid.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: M. Vane</span>
                        <span class="font-mono text-[10px] uppercase">03.22.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1493612276216-ee3925520721?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_101 / Philo</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Deep work or deep distraction?</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: S. Jenkins</span>
                        <span class="font-mono text-[10px] uppercase">03.21.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_100 / Theory</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Analog fetishism in silicon age.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: E. Thorne</span>
                        <span class="font-mono text-[10px] uppercase">03.20.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1511447333015-45b65e60f6d5?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_099 / Philo</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Neuro-aesthetics of glitch.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: Dr. E. Kim</span>
                        <span class="font-mono text-[10px] uppercase">03.19.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1490122417551-6ee9691429d0?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_098 / Urbanism</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Sustainable decay in cityscapes.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: O. Grant</span>
                        <span class="font-mono text-[10px] uppercase">03.18.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1518156677180-95a2893f3e9f?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_097 / Theory</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">The grid as censorship tool.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: J. Casablancas</span>
                        <span class="font-mono text-[10px] uppercase">03.17.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1472289065668-ce650ac443d2?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_096 / Arch</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Brutalism in the cloud.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: M. Vane</span>
                        <span class="font-mono text-[10px] uppercase">03.16.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_095 / Philo</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Ethics of code authorship.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: Dr. E. Kim</span>
                        <span class="font-mono text-[10px] uppercase">03.15.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-r brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1493246507139-91e8bef99c02?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_094 / Urbanism</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Quiet places in noisy hubs.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: O. Grant</span>
                        <span class="font-mono text-[10px] uppercase">03.14.24</span>
                    </div>
                </article>
                <article class="p-8 brutalist-border-b group cursor-pointer">
                    <div class="aspect-square bg-black mb-6 grayscale group-hover:grayscale-0 transition-all overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Thumb">
                    </div>
                    <span class="font-mono text-[10px] uppercase mb-2 block">FileRef: ART_093 / Theory</span>
                    <h3 class="font-black text-2xl uppercase leading-none mb-6 group-hover:text-red-600 tracking-tighter">Digital nihilism manifesto.</h3>
                    <div class="flex justify-between items-center pt-4 border-t border-black">
                        <span class="font-mono text-[10px] uppercase">Author: J. Casablancas</span>
                        <span class="font-mono text-[10px] uppercase">03.13.24</span>
                    </div>
                </article>
            </section>

            <section class="p-16 flex justify-center brutalist-border-b bg-gray-50 dark:bg-black">
                <button class="px-12 py-6 bg-black text-white dark:bg-white dark:text-black font-black uppercase text-xl hover:bg-red-600 hover:text-white transition-all tracking-tighter" type="button">
                    Load_Additional_Files ++
                </button>
            </section>
        </main>

      
        @include('components.footer')
    </div>

    <script>
        (function () {
            const btn = document.getElementById('mode-toggle');
            const root = document.getElementById('root');
            if (!btn || !root) return;

            btn.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                root.classList.toggle('dark-mode');
            });
        })();
    </script>
</body>
</html>
