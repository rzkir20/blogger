<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | THE PROTOCOLS</title>
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
            <section class="grid grid-cols-1 lg:grid-cols-12 brutalist-border-b bg-white">
                <div class="lg:col-span-8 p-8 lg:p-16 brutalist-border-r">
                    <div class="mb-8 font-mono text-xs uppercase tracking-widest text-red-600 font-bold">
                        ARCHIVE_PROTOCOL_V.1.0.4
                    </div>
                    <h1 class="font-black text-7xl md:text-9xl leading-[0.85] tracking-tighter mb-20 uppercase">
                        THE <br> PROTOCOLS.
                    </h1>
                    <div class="space-y-16 lg:space-y-32">
                        <div class="relative group">
                            <span class="protocol-number">01</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">IMPERFECTION IS MANDATORY</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                Error is the evidence of human existence. We refuse the clinical perfection of generative AI. Our pages must retain the noise, the grain, and the misalignment of manual effort.
                            </p>
                        </div>
                        <div class="relative group">
                            <span class="protocol-number">02</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">NO DECORATION WITHOUT PURPOSE</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                Gradients, drop shadows, and glassmorphism are the cosmetics of a dying web. ARCHIVE uses only structure: the grid, the border, and the solid fill.
                            </p>
                        </div>
                        <div class="relative group">
                            <span class="protocol-number">03</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">THE GRID IS THE LAW</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                Alignment is our syntax. The 12-column grid is not a suggestion; it is the rigid framework upon which all editorial thought is constructed. No bleed is accidental.
                            </p>
                        </div>
                        <div class="relative group">
                            <span class="protocol-number">04</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">RAW DATA OVER POLISHED LIES</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                Editorial integrity requires transparency. We show the sources, the timestamps, and the raw metadata. We do not curate for comfort; we document for the truth.
                            </p>
                        </div>
                        <div class="relative group">
                            <span class="protocol-number">05</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">RADICAL MONOCHROME</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                Information has no color. Color is an emotional trigger used for manipulation. We operate in Black and White. Red is reserved strictly for emergencies and manifestos.
                            </p>
                        </div>
                        <div class="relative group text-red-600">
                            <span class="protocol-number">06</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">COLLECTIVE ANONYMITY</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-100 relative z-10 font-bold">
                                The message precedes the messenger. Authors are identifiers, not influencers. We are a node in a network, not a stage for celebrity.
                            </p>
                        </div>
                        <div class="relative group">
                            <span class="protocol-number">07</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">TACTILE DIGITALISM</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                The digital screen should emulate the printed page. We use sharp edges and fixed widths. We respect the fold. We acknowledge the physical limits of the eye.
                            </p>
                        </div>
                        <div class="relative group">
                            <span class="protocol-number">08</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">STATIC AS COMFORT</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                We embrace the silence between transmissions. We do not use infinite scroll. We do not track for engagement. Every transmission has a beginning and an absolute end.
                            </p>
                        </div>
                        <div class="relative group">
                            <span class="protocol-number">09</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">THE BRUTALIST UX</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                If it is difficult to navigate, it is because truth is difficult to find. We do not prioritize 'ease of use'. We prioritize the weight of information.
                            </p>
                        </div>
                        <div class="relative group">
                            <span class="protocol-number">10</span>
                            <h3 class="font-black text-2xl uppercase mb-6 tracking-tighter relative z-10">ARCHIVAL PERMANENCE</h3>
                            <p class="font-mono text-base leading-relaxed max-w-2xl opacity-80 relative z-10">
                                We do not delete. Every error is preserved. Every retraction is documented. The archive is a ledger of human design evolution that cannot be erased.
                            </p>
                        </div>
                    </div>
                </div>
                <aside class="lg:col-span-4">
                    <div class="sticky top-20">
                        <div class="p-8 brutalist-border-b font-mono text-xs uppercase tracking-widest bg-black text-white">
                            SYSTEM_METRICS
                        </div>
                        <div class="p-8 brutalist-border-b space-y-12">
                            <div class="space-y-4">
                                <span class="font-mono text-[10px] uppercase opacity-50 block">Metric_01</span>
                                <h4 class="font-black text-6xl uppercase tracking-tighter">142</h4>
                                <p class="font-mono text-[10px] uppercase">Active_Contributors</p>
                            </div>
                            <div class="space-y-4">
                                <span class="font-mono text-[10px] uppercase opacity-50 block">Metric_02</span>
                                <h4 class="font-black text-6xl uppercase tracking-tighter">3.2K</h4>
                                <p class="font-mono text-[10px] uppercase">Verified_Transmissions</p>
                            </div>
                            <div class="space-y-4">
                                <span class="font-mono text-[10px] uppercase opacity-50 block">Metric_03</span>
                                <h4 class="font-black text-4xl uppercase tracking-tighter italic">SEPT_2021</h4>
                                <p class="font-mono text-[10px] uppercase">Founding_Epoch</p>
                            </div>
                            <div class="space-y-4 pt-8">
                                <h5 class="font-bold uppercase text-xs mb-4">Editorial_Status</h5>
                                <div class="flex items-center gap-3 font-mono text-xs uppercase">
                                    <span class="w-3 h-3 bg-red-600 inline-block animate-pulse"></span>
                                    TRANSMISSION: ACTIVE
                                </div>
                                <div class="flex items-center gap-3 font-mono text-xs uppercase opacity-50">
                                    <span class="w-3 h-3 bg-black inline-block"></span>
                                    ENCRYPTION: RAW
                                </div>
                            </div>
                        </div>
                        <div class="p-12 brutalist-border-b bg-black text-white group cursor-pointer hover:bg-red-600 transition-colors">
                            <h4 class="font-black text-2xl uppercase mb-4 tracking-tighter">WANT TO JOIN THE COLLECTIVE?</h4>
                            <p class="font-mono text-[10px] uppercase mb-8">We accept only those who respect the protocols.</p>
                            <a href="{{ url('/register') }}" id="sidebar-join" class="inline-block border-2 border-white px-8 py-3 font-black uppercase text-xs hover:bg-white hover:text-black transition-colors">Apply_Protocol</a>
                        </div>
                        <div class="p-8">
                            <h4 class="font-black text-xl uppercase mb-6 tracking-tighter">Operational_Files</h4>
                            <ul class="font-mono text-[10px] uppercase space-y-4">
                                <li><a href="#" class="underline hover:text-red-600">Guide_To_Typography.PDF</a></li>
                                <li><a href="#" class="underline hover:text-red-600">Submission_Protocol.MD</a></li>
                                <li><a href="#" class="underline hover:text-red-600">Archive_Ethics_V2.TXT</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </section>

            <section class="p-8 lg:p-16 brutalist-border-b bg-red-600 text-white">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="font-black text-7xl lg:text-9xl uppercase leading-[0.8] tracking-tighter mb-8">Subscribe <br> or Die.</h2>
                        <p class="font-mono text-sm max-w-md uppercase mb-8">Join the network. Get the raw data. No marketing fluff. Just editorial integrity delivered to your inbox weekly.</p>
                    </div>
                    <form class="space-y-4" action="#" method="get" onsubmit="return false">
                        <div class="flex brutalist-border-4 border-white">
                            <input type="email" name="email" placeholder="ENTER_EMAIL_HERE" class="flex-1 bg-transparent p-6 font-mono text-lg focus:outline-none placeholder-white/50 text-white border-0" autocomplete="email">
                            <button type="button" class="px-12 bg-white text-black font-black uppercase hover:bg-black hover:text-white transition-all">Connect</button>
                        </div>
                        <p class="font-mono text-[10px] uppercase opacity-80">By connecting, you agree to the protocols and the consequences of the truth.</p>
                    </form>
                </div>
            </section>
        </main>

        <footer class="bg-black text-white p-8 lg:p-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-6">
                    <a href="{{ url('/') }}" class="font-black text-4xl tracking-tighter mb-8 block">ARCHIVE.</a>
                    <p class="font-mono text-sm max-w-sm uppercase mb-12 opacity-60">A decentralized editorial node for the preservation of raw human thought in an automated age.</p>
                    <div class="flex gap-12 font-mono text-[10px] uppercase tracking-[0.3em]">
                        <span>LOC: 52.5200° N, 13.4050° E</span>
                        <span>ID: NODE_001</span>
                    </div>
                </div>
                <div class="lg:col-span-3 lg:border-l border-white/20 lg:pl-12">
                    <h4 class="font-mono text-xs uppercase mb-8 opacity-40">Protocols</h4>
                    <ul class="space-y-4 font-black text-2xl uppercase tracking-tighter">
                        <li><a href="{{ url('/changelog') }}" id="f-changelog" class="hover:text-red-600 transition-colors">Changelog</a></li>
                        <li><a href="{{ url('/authors') }}" id="f-authors" class="hover:text-red-600 transition-colors">Collective</a></li>
                        <li><a href="{{ url('/explore') }}" id="f-archive" class="hover:text-red-600 transition-colors">The_Vault</a></li>
                        <li><a href="{{ url('/search') }}" id="f-search" class="hover:text-red-600 transition-colors">Retrieval</a></li>
                    </ul>
                </div>
                <div class="lg:col-span-3 lg:border-l border-white/20 lg:pl-12">
                    <h4 class="font-mono text-xs uppercase mb-8 opacity-40">Networks</h4>
                    <ul class="space-y-4 font-black text-2xl uppercase tracking-tighter">
                        <li><a href="#" id="f-x" class="hover:text-red-600 transition-colors">X_Protocol</a></li>
                        <li><a href="#" id="f-inst" class="hover:text-red-600 transition-colors">Visual_Nodes</a></li>
                        <li><a href="#" id="f-git" class="hover:text-red-600 transition-colors">Source_Core</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-32 pt-8 border-t border-white/20 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 font-mono text-[10px] uppercase">
                <span>Archive Editorial (c) {{ date('Y') }} / Node_v1.0.4</span>
                <span class="flex gap-8">
                    <a href="#" id="f-priv">Privacy_Policy</a>
                    <a href="#" id="f-terms">Term_Conditions</a>
                </span>
            </div>
        </footer>
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
