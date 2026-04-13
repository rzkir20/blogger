<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | Two-Step Registration Protocol</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@400,600,800&f[]=archivo-black@400&f[]=jet-brains-mono@400&display=swap" rel="stylesheet">
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen flex flex-col">
        @include('components.header')

        <main class="flex-1 grid grid-cols-1 lg:grid-cols-12">
            <section class="lg:col-span-4 p-8 lg:p-12 brutalist-border-r flex flex-col justify-between bg-zinc-50 dark:bg-zinc-900 transition-colors">
                <div class="space-y-12">
                    <div>
                        <span class="font-mono text-xs uppercase tracking-widest bg-black text-white px-3 py-1 inline-block mb-6">Protocol / Registry</span>
                        <h1 class="font-black text-6xl lg:text-8xl uppercase tracking-tighter leading-none text-white">
                            SIGN <br> UP.
                        </h1>
                    </div>

                    <div class="space-y-8">
                        <div class="space-y-4">
                            <span id="step-label" class="font-mono text-xs uppercase opacity-60 text-white">Current_Status: {{ ($errors->any() || old('email')) ? 'STEP_2/2' : 'STEP_1/2' }}</span>
                            <div class="grid grid-cols-2 gap-0 border-2 border-black dark:border-white">
                                <div id="step-indicator-1" class="h-4 bg-red-600 brutalist-border-r"></div>
                                <div id="step-indicator-2" class="h-4 {{ ($errors->any() || old('email')) ? 'bg-red-600' : 'bg-transparent' }}"></div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="font-black text-xl uppercase tracking-tighter text-white">Why Join?</h3>
                            <ul class="font-mono text-[10px] uppercase space-y-3 opacity-80 text-white">
                                <li class="flex gap-3"><iconify-icon icon="lucide:check-circle" class="accent-red"></iconify-icon> Access deep-archive files</li>
                                <li class="flex gap-3"><iconify-icon icon="lucide:check-circle" class="accent-red"></iconify-icon> Connect with other nodes</li>
                                <li class="flex gap-3"><iconify-icon icon="lucide:check-circle" class="accent-red"></iconify-icon> Contribute to visual discourse</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="font-mono text-[10px] uppercase opacity-40">
                    <p class="text-white">Registry_Version: 4.0.1</p>
                    <p class="text-white">Encryption: Enabled_Manual</p>
                </div>
            </section>

            <section class="lg:col-span-8 p-8 lg:p-16">
                <div class="max-w-4xl mx-auto">
                    <div id="step-1-content" class="space-y-12 @if($errors->any() || old('email')) hidden-step @endif">
                        <div class="space-y-2">
                            <h2 class="font-black text-4xl uppercase tracking-tighter">Classification Set_01</h2>
                            <p class="font-mono text-xs uppercase opacity-60">Choose your node type first. Credentials follow in the next step.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <button type="button" id="role-reader" class="role-card {{ old('role', 'reader') === 'reader' ? 'active' : '' }} p-8 brutalist-border text-left group transition-all hover:border-red-600">
                                <iconify-icon icon="lucide:book-open" class="text-4xl mb-6 accent-red"></iconify-icon>
                                <h3 class="font-black text-2xl uppercase tracking-tighter mb-2">Reader_Node</h3>
                                <p class="font-mono text-[10px] uppercase opacity-60 leading-relaxed">Access all files, engage in discourse, support the collective nodes.</p>
                            </button>
                            <button type="button" id="role-writer" class="role-card {{ old('role') === 'writer' ? 'active' : '' }} p-8 brutalist-border text-left group transition-all hover:border-red-600">
                                <iconify-icon icon="lucide:pen-tool" class="text-4xl mb-6 accent-red"></iconify-icon>
                                <h3 class="font-black text-2xl uppercase tracking-tighter mb-2">Writer_Node</h3>
                                <p class="font-mono text-[10px] uppercase opacity-60 leading-relaxed">Submit transmissions, edit archival data, influence editorial protocols.</p>
                            </button>
                        </div>

                        <button type="button" id="next-step-btn" class="group flex items-center justify-between w-full p-8 bg-black text-white font-black uppercase text-2xl tracking-tighter hover:bg-red-600 transition-all">
                            <span>PROCEED_PROTOCOL</span>
                            <iconify-icon icon="lucide:arrow-right" class="group-hover:translate-x-2 transition-transform"></iconify-icon>
                        </button>
                    </div>

                    <div id="step-2-content" class="space-y-12 @unless($errors->any() || old('email')) hidden-step @endunless">
                        <div class="space-y-2">
                            <h2 class="font-black text-4xl uppercase tracking-tighter">Credential Set_02</h2>
                            <p class="font-mono text-xs uppercase opacity-60">Establish your identifier, profile, and access codes.</p>
                        </div>

                        <form class="space-y-10" method="post" action="{{ route('register.store') }}">
                            @csrf
                            <input type="hidden" name="role" id="role-input" value="{{ old('role', 'reader') }}">

                            @if ($errors->any())
                                <div class="p-4 brutalist-border bg-red-50 dark:bg-red-950 text-red-900 dark:text-red-100 font-mono text-xs uppercase" role="alert">
                                    <ul class="list-disc pl-4 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="space-y-2">
                                <label class="font-mono text-[10px] uppercase font-bold" for="identity-email">Identity_Email</label>
                                <x-ui.input type="email" id="identity-email" name="email" value="{{ old('email') }}" placeholder="USER@DOMAIN.COM" class="uppercase" required autocomplete="username" />
                            </div>

                            <div class="space-y-2">
                                <label class="font-mono text-[10px] uppercase font-bold" for="full-name">Full_Human_Name</label>
                                <x-ui.input type="text" id="full-name" name="name" value="{{ old('name') }}" placeholder="JULIAN CASABLANCAS" class="uppercase" required autocomplete="name" />
                            </div>

                            <div class="space-y-2">
                                <label class="font-mono text-[10px] uppercase font-bold" for="changelog-bio">Changelog_Bio</label>
                                <x-ui.textarea id="changelog-bio" name="bio" rows="3" placeholder="EXPLAIN YOUR VISUAL PHILOSOPHY...">{{ old('bio') }}</x-ui.textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="font-mono text-[10px] uppercase font-bold" for="password">Password</label>
                                    <x-ui.input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="new-password" />
                                </div>
                                <div class="space-y-2">
                                    <label class="font-mono text-[10px] uppercase font-bold" for="password-confirmation">Confirm Password</label>
                                    <x-ui.input type="password" id="password-confirmation" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <button type="button" id="prev-step-btn" class="px-10 py-6 brutalist-border font-black uppercase text-sm hover-red transition-all">BACK_STEP</button>
                                <button type="submit" class="flex-1 py-6 bg-black text-white font-black uppercase text-xl tracking-tighter hover:bg-red-600 transition-all">FINALIZE_REGISTRATION</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        @include('components.footer')
    </div>

    <script>
        (function () {
            const step1Content = document.getElementById('step-1-content');
            const step2Content = document.getElementById('step-2-content');
            const stepLabel = document.getElementById('step-label');
            const stepIndicator2 = document.getElementById('step-indicator-2');
            const roleReader = document.getElementById('role-reader');
            const roleWriter = document.getElementById('role-writer');
            const roleInput = document.getElementById('role-input');
            const nextStepButton = document.getElementById('next-step-btn');
            const prevStepButton = document.getElementById('prev-step-btn');

            function syncRoleField() {
                if (!roleInput || !roleReader || !roleWriter) return;
                roleInput.value = roleReader.classList.contains('active') ? 'reader' : 'writer';
            }

            if (nextStepButton && step1Content && step2Content && stepLabel && stepIndicator2) {
                nextStepButton.addEventListener('click', function () {
                    step1Content.classList.add('hidden-step');
                    step2Content.classList.remove('hidden-step');
                    stepLabel.innerText = 'Current_Status: STEP_2/2';
                    stepIndicator2.classList.add('bg-red-600');
                    window.scrollTo(0, 0);
                });
            }

            if (prevStepButton && step1Content && step2Content && stepLabel && stepIndicator2) {
                prevStepButton.addEventListener('click', function () {
                    step2Content.classList.add('hidden-step');
                    step1Content.classList.remove('hidden-step');
                    stepLabel.innerText = 'Current_Status: STEP_1/2';
                    stepIndicator2.classList.remove('bg-red-600');
                    window.scrollTo(0, 0);
                });
            }

            if (roleReader && roleWriter) {
                roleReader.addEventListener('click', function () {
                    roleReader.classList.add('active');
                    roleWriter.classList.remove('active');
                    syncRoleField();
                });

                roleWriter.addEventListener('click', function () {
                    roleWriter.classList.add('active');
                    roleReader.classList.remove('active');
                    syncRoleField();
                });

                syncRoleField();
            }
        })();
    </script>
</body>
</html>
