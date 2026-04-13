<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | RAW LOGIN</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen flex flex-col">
        @include('components.header')

        <main class="flex-1 grid grid-cols-1 lg:grid-cols-12">
            <section class="lg:col-span-7 p-8 lg:p-16 brutalist-border-r flex flex-col justify-between overflow-hidden">
                <div>
                    <div class="mb-8 font-mono text-xs uppercase tracking-widest bg-black text-white px-3 py-1 inline-block">
                        Access_Protocol / 001
                    </div>
                    <h1 class="font-black text-7xl md:text-9xl lg:text-[12rem] uppercase tracking-tighter leading-[0.8] mb-12">
                        LOG <br> IN.
                    </h1>
                </div>
                <div class="max-w-xl space-y-8">
                    <p class="text-2xl font-bold uppercase leading-tight">
                        Accessing the internal node registry requires valid credentials. Unauthorized entry is logged via global protocols.
                    </p>
                    <div class="flex gap-8 font-mono text-[10px] uppercase opacity-60">
                        <div class="space-y-1"><span>System_Status</span><br><span class="accent-red font-bold">SECURE</span></div>
                        <div class="space-y-1"><span>Uptime</span><br><span class="text-black font-bold dark:text-white">99.98%</span></div>
                        <div class="space-y-1"><span>Latency</span><br><span class="text-black font-bold dark:text-white">12MS</span></div>
                    </div>
                </div>
            </section>

            <section class="lg:col-span-5 p-8 lg:p-16 bg-white flex flex-col justify-center">
                <div class="max-w-md w-full mx-auto space-y-12">
                    <div class="space-y-4">
                        <h2 class="font-black text-4xl uppercase tracking-tighter">Identify Yourself</h2>
                        <p class="font-mono text-xs uppercase opacity-60">Enter your data to established connection.</p>
                    </div>

                    <form class="space-y-8" method="post" action="{{ route('login.store') }}" id="login-form">
                        @csrf

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
                            <label for="email" class="font-mono text-[10px] uppercase font-bold block">Email_Address</label>
                            <x-ui.input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="NODE_USER@PROTOCOL.COM" class="p-4 uppercase" required autocomplete="username" />
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <label for="password" class="font-mono text-[10px] uppercase font-bold">Access_Code</label>
                                <a href="#" id="link-forgot" class="font-mono text-[10px] uppercase accent-red hover:underline">Lost_Access?</a>
                            </div>
                            <x-ui.input type="password" name="password" id="password" placeholder="••••••••" class="p-4" required autocomplete="current-password" />
                        </div>

                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="remember" id="remember" value="1" class="w-4 h-4 brutalist-border bg-transparent checked:bg-red-600 appearance-none" @checked(old('remember'))>
                            <label for="remember" class="font-mono text-[10px] uppercase cursor-pointer">Persistent_Connection</label>
                        </div>

                        <button type="submit" class="w-full py-6 bg-black text-white font-black uppercase text-xl tracking-tighter hover:bg-red-600 transition-all">
                            INITIATE_LOGIN
                        </button>
                    </form>

                    <div class="pt-8 brutalist-border-t border-black">
                        <p class="font-mono text-xs uppercase mb-4 opacity-60">New contributor found?</p>
                        <a href="{{ url('/register') }}" id="link-signup" class="inline-block font-black text-2xl uppercase tracking-tighter hover:accent-red">
                            Register_New_Node +
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="brutalist-border-t bg-black text-white p-6">
            <div class="max-w-7xl mx-auto flex justify-between items-center font-mono text-[10px] uppercase">
                <span>Archive_Login_Node (c) {{ date('Y') }} / Auth_v4.0</span>
                <span class="flex gap-8">
                    <a href="#" class="hover:underline">Privacy_Protocols</a>
                    <a href="#" class="hover:underline">Encryption_Terms</a>
                </span>
            </div>
        </footer>
    </div>

    <script>
        (function () {
            const toggleButton = document.getElementById('mode-toggle');
            const root = document.getElementById('root');

            if (toggleButton && root) {
                toggleButton.addEventListener('click', function () {
                    document.body.classList.toggle('dark-mode');
                    root.classList.toggle('dark-mode');
                });
            }

            const form = document.getElementById('login-form');
            if (!form) return;

            form.addEventListener('submit', function () {
                const submitButton = form.querySelector('button[type="submit"]');
                if (!submitButton) return;
                submitButton.disabled = true;
                submitButton.textContent = 'CONNECTING...';
            });
        })();
    </script>
</body>
</html>
