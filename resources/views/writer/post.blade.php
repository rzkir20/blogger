<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Archive | Writer Dashboard</title>
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
        @include('components.writer.sidebar', ['active' => $activeNav ?? 'posts'])

        <div class="flex flex-1 flex-col xl:flex-row min-w-0">
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-12 relative pb-32">
                <section class="space-y-4 border-b-2 border-zinc-900 dark:border-zinc-300 pb-8">
                    <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Archives / Content Management</p>
                    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                        <h1 class="font-black text-5xl sm:text-6xl lg:text-8xl leading-[0.85] tracking-tighter uppercase">
                            Posts<br>Archive.
                        </h1>
                        <a href="#" id="header-new-post-btn" class="brutalist-btn-black inline-block text-center shrink-0">
                            Create New Entry +
                        </a>
                    </div>
                </section>

                <section class="flex flex-col xl:flex-row gap-6 items-stretch xl:items-end">
                    <div class="flex-1 space-y-2">
                        <label class="font-mono text-xs font-black uppercase tracking-widest opacity-80">Search Archives</label>
                        <div class="relative">
                            <input type="text" placeholder="Keyword, Title, or Topic..." class="w-full brutalist-input pl-12 dark:bg-transparent">
                            <iconify-icon icon="lucide:search" class="absolute left-4 top-1/2 -translate-y-1/2 text-xl text-zinc-950 dark:text-zinc-50 pointer-events-none"></iconify-icon>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 xl:w-1/2">
                        <div class="space-y-2">
                            <label class="font-mono text-xs font-black uppercase tracking-widest opacity-80">Status</label>
                            <select class="w-full brutalist-input h-[46px] dark:bg-transparent appearance-none cursor-pointer">
                                <option>All Status</option>
                                <option>Published</option>
                                <option>Draft</option>
                                <option>Archived</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="font-mono text-xs font-black uppercase tracking-widest opacity-80">Category</label>
                            <select class="w-full brutalist-input h-[46px] dark:bg-transparent appearance-none cursor-pointer">
                                <option>All Categories</option>
                                <option>Design</option>
                                <option>Culture</option>
                                <option>Technology</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="font-mono text-xs font-black uppercase tracking-widest opacity-80">Sort By</label>
                            <select class="w-full brutalist-input h-[46px] dark:bg-transparent appearance-none cursor-pointer">
                                <option>Newest</option>
                                <option>Most Views</option>
                                <option>Oldest</option>
                            </select>
                        </div>
                    </div>
                </section>

                <section class="border-t-2 border-zinc-900 dark:border-zinc-300 overflow-x-auto">
                    <table class="w-full border-collapse min-w-[720px]">
                        <thead>
                            <tr class="border-b border-zinc-900 dark:border-zinc-300 text-left uppercase font-mono text-[10px] font-black tracking-widest bg-gray-50 dark:bg-zinc-900">
                                <th class="p-6 w-12"><input type="checkbox" class="w-4 h-4 accent-black dark:accent-white" aria-label="Select all"></th>
                                <th class="p-6 min-w-[300px]">Publication Title</th>
                                <th class="p-6">Date</th>
                                <th class="p-6">Reach</th>
                                <th class="p-6">Status</th>
                                <th class="p-6 text-right">Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/10 dark:divide-white/10">
                            <tr class="group hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors cursor-default">
                                <td class="p-6"><input type="checkbox" class="w-4 h-4 accent-black dark:accent-white group-hover:accent-white dark:group-hover:accent-black" aria-label="Select row"></td>
                                <td class="p-6">
                                    <h3 class="text-xl md:text-2xl font-black uppercase leading-tight">Raw Truths: The Death of Modern Design Systems</h3>
                                    <p class="font-mono text-[10px] font-bold mt-1 opacity-60 group-hover:opacity-60">Category: Design Systems</p>
                                </td>
                                <td class="p-6 whitespace-nowrap text-sm font-black uppercase">Sept 24, 2024</td>
                                <td class="p-6 whitespace-nowrap">
                                    <span class="text-lg font-black">42,102</span>
                                    <span class="font-mono text-[10px] block font-bold opacity-60 uppercase">Total Views</span>
                                </td>
                                <td class="p-6">
                                    <span class="inline-block border-2 border-zinc-900 dark:border-zinc-300 px-3 py-1 font-mono text-[10px] font-black uppercase group-hover:border-zinc-100 dark:group-hover:border-zinc-600">Published</span>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <button type="button" class="hover:scale-125 transition-transform" aria-label="Edit"><iconify-icon icon="lucide:edit-3" class="text-xl"></iconify-icon></button>
                                        <button type="button" class="hover:scale-125 transition-transform hover:text-red-500 dark:hover:text-red-600" aria-label="Delete"><iconify-icon icon="lucide:trash-2" class="text-xl"></iconify-icon></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors cursor-default">
                                <td class="p-6"><input type="checkbox" class="w-4 h-4 accent-black dark:accent-white group-hover:accent-white dark:group-hover:accent-black" aria-label="Select row"></td>
                                <td class="p-6">
                                    <h3 class="text-xl md:text-2xl font-black uppercase leading-tight">Minimalism as a Form of Rebellion</h3>
                                    <p class="font-mono text-[10px] font-bold mt-1 opacity-60">Category: Philosophy</p>
                                </td>
                                <td class="p-6 whitespace-nowrap text-sm font-black uppercase">Sept 18, 2024</td>
                                <td class="p-6 whitespace-nowrap">
                                    <span class="text-lg font-black">18,449</span>
                                    <span class="font-mono text-[10px] block font-bold opacity-60 uppercase">Total Views</span>
                                </td>
                                <td class="p-6">
                                    <span class="inline-block border-2 border-zinc-900 dark:border-zinc-300 px-3 py-1 font-mono text-[10px] font-black uppercase group-hover:border-zinc-100 dark:group-hover:border-zinc-600">Published</span>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <button type="button" class="hover:scale-125 transition-transform" aria-label="Edit"><iconify-icon icon="lucide:edit-3" class="text-xl"></iconify-icon></button>
                                        <button type="button" class="hover:scale-125 transition-transform hover:text-red-500 dark:hover:text-red-600" aria-label="Delete"><iconify-icon icon="lucide:trash-2" class="text-xl"></iconify-icon></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors cursor-default">
                                <td class="p-6"><input type="checkbox" class="w-4 h-4 accent-black dark:accent-white group-hover:accent-white dark:group-hover:accent-black" aria-label="Select row"></td>
                                <td class="p-6">
                                    <h3 class="text-xl md:text-2xl font-black uppercase leading-tight">The Archive Project: Reclaiming History</h3>
                                    <p class="font-mono text-[10px] font-bold mt-1 opacity-60">Category: History</p>
                                </td>
                                <td class="p-6 whitespace-nowrap text-sm font-black uppercase">Sept 12, 2024</td>
                                <td class="p-6 whitespace-nowrap">
                                    <span class="text-lg font-black">9,221</span>
                                    <span class="font-mono text-[10px] block font-bold opacity-60 uppercase">Total Views</span>
                                </td>
                                <td class="p-6">
                                    <span class="inline-block border-2 border-dashed border-zinc-900 dark:border-zinc-300 px-3 py-1 font-mono text-[10px] font-black uppercase group-hover:border-zinc-100 dark:group-hover:border-zinc-600">Draft</span>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <button type="button" class="hover:scale-125 transition-transform" aria-label="Edit"><iconify-icon icon="lucide:edit-3" class="text-xl"></iconify-icon></button>
                                        <button type="button" class="hover:scale-125 transition-transform hover:text-red-500 dark:hover:text-red-600" aria-label="Delete"><iconify-icon icon="lucide:trash-2" class="text-xl"></iconify-icon></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors cursor-default">
                                <td class="p-6"><input type="checkbox" class="w-4 h-4 accent-black dark:accent-white group-hover:accent-white dark:group-hover:accent-black" aria-label="Select row"></td>
                                <td class="p-6">
                                    <h3 class="text-xl md:text-2xl font-black uppercase leading-tight">Typography as Architectural Form</h3>
                                    <p class="font-mono text-[10px] font-bold mt-1 opacity-60">Category: Arts</p>
                                </td>
                                <td class="p-6 whitespace-nowrap text-sm font-black uppercase">Aug 29, 2024</td>
                                <td class="p-6 whitespace-nowrap">
                                    <span class="text-lg font-black">12,044</span>
                                    <span class="font-mono text-[10px] block font-bold opacity-60 uppercase">Total Views</span>
                                </td>
                                <td class="p-6">
                                    <span class="inline-block bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-3 py-1 font-mono text-[10px] font-black uppercase group-hover:bg-zinc-100 group-hover:text-zinc-950 dark:group-hover:bg-zinc-950 dark:group-hover:text-zinc-50">Archived</span>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <button type="button" class="hover:scale-125 transition-transform" aria-label="View"><iconify-icon icon="lucide:eye" class="text-xl"></iconify-icon></button>
                                        <button type="button" class="hover:scale-125 transition-transform hover:text-red-500 dark:hover:text-red-600" aria-label="Delete"><iconify-icon icon="lucide:trash-2" class="text-xl"></iconify-icon></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="flex flex-col md:flex-row justify-between items-center gap-6 pt-6">
                    <p class="font-mono text-xs font-black uppercase tracking-widest opacity-60">Showing 1-10 of 124 Archives</p>
                    <div class="flex flex-wrap gap-2 justify-center">
                        <button type="button" class="w-12 h-12 brutalist-btn flex items-center justify-center p-0" aria-label="Previous page"><iconify-icon icon="lucide:chevron-left"></iconify-icon></button>
                        <button type="button" class="w-12 h-12 brutalist-btn-black flex items-center justify-center p-0" aria-current="page">1</button>
                        <button type="button" class="w-12 h-12 brutalist-btn flex items-center justify-center p-0">2</button>
                        <button type="button" class="w-12 h-12 brutalist-btn flex items-center justify-center p-0">3</button>
                        <span class="w-12 h-12 flex items-center justify-center font-bold">…</span>
                        <button type="button" class="w-12 h-12 brutalist-btn flex items-center justify-center p-0">13</button>
                        <button type="button" class="w-12 h-12 brutalist-btn flex items-center justify-center p-0" aria-label="Next page"><iconify-icon icon="lucide:chevron-right"></iconify-icon></button>
                    </div>
                </section>

                <footer class="absolute bottom-0 left-0 right-0 border-t border-zinc-900 dark:border-zinc-300 p-8 px-6 md:px-12 writer-app bg-white dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <span class="text-lg font-black tracking-tighter uppercase">Writer. Archive Unit</span>
                        <p class="font-mono text-[10px] font-black uppercase opacity-60">© {{ date('Y') }}. Systematic Editorial Control.</p>
                    </div>
                </footer>
            </main>

            @include('components.writer.profile-aside')
        </div>
    </div>

    <script>
        (function () {
            const root = document.getElementById('root');
            const btn = document.getElementById('writer-mode-toggle');
            if (btn && root) {
                btn.addEventListener('click', function () {
                    document.body.classList.toggle('dark-mode');
                    root.classList.toggle('dark-mode');
                });
            }
        })();
    </script>
</body>
</html>
