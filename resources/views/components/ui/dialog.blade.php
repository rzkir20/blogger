@props([
    'id',
    'title' => '',
    'description' => null,
])

<div
    id="{{ $id }}"
    data-dialog
    class="fixed inset-0 hidden"
    style="z-index: 9999;"
    role="dialog"
    aria-modal="true"
    aria-hidden="true"
>
    <div
        class="absolute inset-0 bg-zinc-950/55 backdrop-blur-md"
        style="backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);"
        data-dialog-close
    ></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-2xl border-2 border-zinc-900 dark:border-zinc-300 bg-white dark:bg-zinc-950 text-zinc-950 dark:text-zinc-50 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] dark:shadow-[10px_10px_0px_0px_rgba(212,212,216,1)]">
            <div class="p-6 md:p-8 border-b-2 border-zinc-900 dark:border-zinc-300 flex items-start justify-between gap-4">
                <div>
                    <h2 class="font-black text-2xl tracking-tighter uppercase">{{ $title }}</h2>
                    @if ($description)
                        <p class="font-mono text-[10px] uppercase opacity-60 mt-2">{{ $description }}</p>
                    @endif
                </div>
                <button
                    type="button"
                    class="border-2 border-zinc-900 dark:border-zinc-300 px-3 py-1 font-mono text-[10px] uppercase hover:bg-zinc-950 hover:text-zinc-50 dark:hover:bg-zinc-100 dark:hover:text-zinc-950 transition-colors"
                    data-dialog-close
                    aria-label="Close dialog"
                >
                    Close
                </button>
            </div>

            <div class="p-6 md:p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
