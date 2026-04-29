<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE | Accounts Management</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="transition-colors duration-300">
    <div id="root" class="min-h-screen flex flex-col">
        <div class="flex flex-1 flex-col md:flex-row">
            @include('components.dashboard.sidebar', ['active' => 'managements-accounts'])

            <main class="flex-1 p-8 lg:p-16">
                <div class="max-w-5xl">
                    <div class="mb-8 font-mono text-xs uppercase tracking-widest bg-red-600 text-white px-3 py-1 inline-block">
                        Node_Class / Super_Admin
                    </div>
                    <h1 class="font-black text-5xl md:text-7xl uppercase tracking-tighter leading-[0.9] mb-4">
                        Accounts <br> Registry.
                    </h1>
                    <p class="font-mono text-xs uppercase opacity-70 mb-8">
                        Total users: {{ $users->count() }}
                    </p>

                    <x-ui.table
                        title="Users Directory"
                        subtitle="latest first"
                        head-class="bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950"
                    >
                        <x-slot:head>
                            <tr class="font-mono text-[10px] uppercase tracking-widest border-b-2 border-zinc-900 dark:border-zinc-300">
                                <th class="px-4 py-3 border-r border-zinc-300/30 dark:border-zinc-700/40">ID</th>
                                <th class="px-4 py-3 border-r border-zinc-300/30 dark:border-zinc-700/40">Name</th>
                                <th class="px-4 py-3 border-r border-zinc-300/30 dark:border-zinc-700/40">Email</th>
                                <th class="px-4 py-3 border-r border-zinc-300/30 dark:border-zinc-700/40">Role</th>
                                <th class="px-4 py-3">Joined</th>
                            </tr>
                        </x-slot:head>

                        <x-slot:body>
                            @forelse ($users as $user)
                                <tr class="text-sm border-b border-zinc-900/20 dark:border-zinc-300/20 hover:bg-zinc-100 dark:hover:bg-zinc-900/60 transition-colors">
                                    <td class="px-4 py-3 font-mono text-xs border-r border-zinc-900/10 dark:border-zinc-300/10">#{{ $user->id }}</td>
                                    <td class="px-4 py-3 font-bold border-r border-zinc-900/10 dark:border-zinc-300/10 uppercase">{{ $user->name }}</td>
                                    <td class="px-4 py-3 font-mono text-xs border-r border-zinc-900/10 dark:border-zinc-300/10">{{ $user->email }}</td>
                                    <td class="px-4 py-3 border-r border-zinc-900/10 dark:border-zinc-300/10">
                                        <span class="inline-flex border border-zinc-900 dark:border-zinc-300 px-2 py-1 text-[10px] font-black uppercase">
                                            {{ str_replace('_', ' ', $user->normalizedRole()) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 font-mono text-xs">
                                        {{ $user->created_at?->format('d/m/Y H:i') ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-10 text-center font-mono text-xs uppercase opacity-60">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </x-slot:body>
                    </x-ui.table>
                </div>
            </main>

            @include('components.dashboard.profile')
        </div>
    </div>
</body>
</html>
