<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | {{ $pageTitle }} – Article Detail</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen border-8 border-black">
        @include('components.header')

        <main>
            <section class="grid grid-cols-1 lg:grid-cols-12 brutalist-border-b">
                <div class="lg:col-span-8 p-8 lg:p-16 brutalist-border-r">
                    <div class="flex flex-wrap items-center gap-6 mb-12 font-mono text-xs uppercase tracking-widest">
                        <span class="bg-black text-white px-3 py-1">Ref: {{ $articleRef }}</span>
                        <span>/</span>
                        <span>Issue 004</span>
                        <span>/</span>
                        <span class="accent-red font-bold">Design Theory</span>
                        <span>/</span>
                        <span>03.24.2024</span>
                        <span class="opacity-60">/</span>
                        <span class="font-mono text-[10px] normal-case opacity-70">{{ $slug }}</span>
                    </div>

                    <h1 class="font-black text-6xl md:text-8xl lg:text-9xl leading-[0.85] tracking-tighter mb-16 uppercase">
                        {{ $headlineLine1 }} <br> {{ $headlineLine2 }}.
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-end mb-16">
                        <p class="text-2xl font-bold uppercase leading-none tracking-tight">
                            The end of digital <br> perfection and the <br> rise of visual <br> honesty.
                        </p>
                        <div class="font-mono text-[10px] uppercase space-y-2">
                            <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Author</span><span class="font-bold">Julian Casablancas</span></div>
                            <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Words</span><span class="font-bold">2,450</span></div>
                            <div class="flex justify-between border-b border-black dark:border-white pb-1"><span>Read Time</span><span class="font-bold">12 Min</span></div>
                        </div>
                    </div>

                    <div class="brutalist-border-4 mb-16 grayscale group overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=1440" class="w-full h-auto transition-transform duration-700 group-hover:scale-105" alt="Article Cover Image">
                    </div>

                    <div class="max-w-3xl mx-auto space-y-8 text-xl leading-relaxed">
                        <p class="drop-cap font-semibold">
                            For decades, we have chased the ghost of perfect pixels. The digital revolution promised us a world without grain, without noise, and without error. We built interfaces that were so clean they felt sterile, and algorithms so precise they felt inhuman. But in our quest for the absolute, we lost the very thing that makes communication meaningful: the friction.
                        </p>
                        <p>
                            Brutalism isn't just an architectural choice; it's a rebellion. It is the visible admission of structure. It's the refusal to hide behind gradients and soft shadows. When we look at the raw grid of an editorial page, we aren't just seeing a layout; we are seeing the skeleton of the thought itself.
                        </p>
                        <div class="p-8 brutalist-border my-12 bg-black text-white">
                            <h3 class="font-black text-3xl uppercase mb-4 tracking-tighter">"PERFECTION IS A FORM OF CENSORSHIP."</h3>
                            <p class="font-mono text-sm uppercase">— Protocol 001: The ARCHIVE Manifesto</p>
                        </div>
                        <p>
                            We are seeing a return to the tactile. The rise of analog fetishism—film cameras, vinyl records, risograph prints—isn't just nostalgia. It's a survival mechanism. In an era where AI can generate a 'perfect' image in seconds, the only thing that retains value is the mistake. The misalignment. The raw, unpolished truth of human effort.
                        </p>
                        <h2 class="font-black text-4xl uppercase tracking-tighter mt-16 mb-8">I. THE GRID AS CAGE</h2>
                        <p>
                            Every design system today is a variation of the same cage. We align to 8pt grids because it makes the math easy, not because it makes the message better. We have prioritized 'user experience' over 'human experience'. The difference is subtle but vital. One aims to minimize friction to maximize consumption; the other aims to create a moment of genuine encounter.
                        </p>
                    </div>
                </div>

                <aside class="lg:col-span-4">
                    <div class="sticky top-20">
                        <div class="p-8 brutalist-border-b font-mono text-xs uppercase tracking-widest bg-black text-white">
                            Metric_Data_Stream
                        </div>
                        <div class="p-8 brutalist-border-b space-y-8">
                            <div>
                                <h4 class="font-black text-xl uppercase mb-4 tracking-tighter">Keywords</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="border border-black dark:border-white px-3 py-1 text-[10px] font-mono uppercase">#Brutalism</span>
                                    <span class="border border-black dark:border-white px-3 py-1 text-[10px] font-mono uppercase">#Design_Ethics</span>
                                    <span class="border border-black dark:border-white px-3 py-1 text-[10px] font-mono uppercase">#Grid_Systems</span>
                                    <span class="border border-black dark:border-white px-3 py-1 text-[10px] font-mono uppercase">#Typography</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-black text-xl uppercase mb-4 tracking-tighter">Share_Protocol</h4>
                                <div class="grid grid-cols-2 gap-0 border-2 border-black dark:border-white">
                                    <a href="#" class="p-4 text-center font-mono text-[10px] uppercase brutalist-border-r brutalist-border-b hover-red">X_Network</a>
                                    <button type="button" id="share-copy" class="p-4 text-center font-mono text-[10px] uppercase brutalist-border-b hover-red w-full bg-transparent cursor-pointer">Copy_Link</button>
                                    <a href="#" class="p-4 text-center font-mono text-[10px] uppercase brutalist-border-r hover-red">Email_Enc</a>
                                    <a href="#" class="p-4 text-center font-mono text-[10px] uppercase hover-red">Print_Doc</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-8 brutalist-border-b bg-red-600 text-white">
                            <h4 class="font-black text-2xl uppercase mb-4 tracking-tighter leading-none">Support The Archive Collective</h4>
                            <p class="text-xs font-mono uppercase mb-6">Our journalism is funded by readers. Help us keep the transmissions raw.</p>
                            <a href="#" class="block w-full py-4 text-center bg-white text-black font-black uppercase text-sm hover:bg-black hover:text-white transition-colors">Contribute $10</a>
                        </div>
                        <div class="p-8">
                            <h4 class="font-black text-xl uppercase mb-6 tracking-tighter">Next_Transmission</h4>
                            <a href="{{ url('/articles/analog-fetishism-in-the-age-of-silicon') }}" class="group cursor-pointer block">
                                <div class="aspect-video bg-black mb-4 overflow-hidden brutalist-border grayscale group-hover:grayscale-0">
                                    <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover" alt="Related">
                                </div>
                                <h5 class="font-bold text-lg uppercase leading-none mb-2 group-hover:text-red-600">Analog fetishism in the age of silicon.</h5>
                                <div class="font-mono text-[10px] uppercase">Author: E. Thorne</div>
                            </a>
                        </div>
                    </div>
                </aside>
            </section>

            <section class="p-8 lg:p-16 brutalist-border-b">
                <h2 class="font-black text-4xl lg:text-6xl uppercase tracking-tighter mb-12">More From Julian Casablancas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 border-t-2 border-l-2 border-black dark:border-white">
                    <a href="{{ url('/articles/the-death-of-the-landing-page') }}" class="p-6 border-r-2 border-b-2 border-black dark:border-white group cursor-pointer hover:bg-black hover:text-white transition-colors block">
                        <span class="font-mono text-[10px] block mb-4">REF: ART_082</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-4">The death of the landing page.</h3>
                        <p class="text-xs mb-6 opacity-60 uppercase">Exploring the shift toward decentralized information nodes.</p>
                        <span class="font-mono text-[10px] underline">Open File</span>
                    </a>
                    <a href="{{ url('/articles/type-as-image-image-as-type') }}" class="p-6 border-r-2 border-b-2 border-black dark:border-white group cursor-pointer hover:bg-black hover:text-white transition-colors block">
                        <span class="font-mono text-[10px] block mb-4">REF: ART_075</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-4">Type as image / image as type.</h3>
                        <p class="text-xs mb-6 opacity-60 uppercase">When visual meaning transcends the literal word.</p>
                        <span class="font-mono text-[10px] underline">Open File</span>
                    </a>
                    <a href="{{ url('/articles/the-manifesto-of-imperfection') }}" class="p-6 border-r-2 border-b-2 border-black dark:border-white group cursor-pointer hover:bg-black hover:text-white transition-colors text-white bg-red-600 block">
                        <span class="font-mono text-[10px] block mb-4">REF: MANI_002</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-4">The Manifesto of Imperfection.</h3>
                        <p class="text-xs mb-6 uppercase">Protocol for human-first digital creation.</p>
                        <span class="font-mono text-[10px] underline">Open File</span>
                    </a>
                    <a href="{{ url('/articles/static-noise-as-comfort') }}" class="p-6 border-r-2 border-b-2 border-black dark:border-white group cursor-pointer hover:bg-black hover:text-white transition-colors block">
                        <span class="font-mono text-[10px] block mb-4">REF: ART_041</span>
                        <h3 class="font-black text-2xl uppercase leading-none mb-4">Static Noise as Comfort.</h3>
                        <p class="text-xs mb-6 opacity-60 uppercase">The psychology of white noise in open digital systems.</p>
                        <span class="font-mono text-[10px] underline">Open File</span>
                    </a>
                </div>
            </section>
        </main>

        @include('components.footer')
    </div>

    <script>
        (function () {
            var btn = document.getElementById('share-copy');
            if (!btn) return;
            btn.addEventListener('click', function () {
                var url = window.location.href;
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(function () {
                        var t = btn.textContent;
                        btn.textContent = 'COPIED';
                        setTimeout(function () { btn.textContent = t; }, 2000);
                    });
                }
            });
        })();
    </script>
</body>
</html>
