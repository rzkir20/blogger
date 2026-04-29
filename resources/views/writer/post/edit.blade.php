<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | Writer Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <main class="flex-1 min-w-0 p-6 md:p-12 space-y-8">
                <section class="space-y-4 border-b-2 border-zinc-900 dark:border-zinc-300 pb-8">
                    <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Posts / Edit</p>
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                        <h1 class="font-black text-5xl sm:text-6xl tracking-tighter uppercase">Edit Article</h1>
                        <button
                            type="button"
                            class="brutalist-btn-black inline-block text-center shrink-0"
                            data-dialog-trigger="writer-with-ai-dialog"
                        >
                            Writer with AI
                        </button>
                    </div>
                </section>

                <form id="writer-post-edit-form" method="post" action="{{ route('writer.posts.update', $post) }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <x-ui.label text="Title" />
                            <x-ui.input type="text" name="title" :value="old('title', $post->title)" class="brutalist-input" required />
                        </div>
                        <div class="space-y-2">
                            <x-ui.label text="Category" />
                            <x-ui.input type="text" name="category" :value="old('category', $post->category)" class="brutalist-input" list="post-edit-categories-list" required />
                            <datalist id="post-edit-categories-list">
                                @foreach ($categories as $categoryOption)
                                    <option value="{{ $categoryOption }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="space-y-2">
                            <x-ui.label text="Author" />
                            <x-ui.input type="text" name="author" :value="old('author', $post->author)" class="brutalist-input" required readonly />
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <x-ui.label text="Thumbnail" />
                            <x-ui.file
                                name="thumbnail"
                                id-prefix="post-edit-thumbnail"
                                accept="image/*,.avif"
                                drop-text="Drop thumbnail here or click to browse"
                                helper-text="Recommended: landscape image for article card"
                                upload-button-text="Upload Thumbnail"
                                remove-button-text="Remove Thumbnail"
                                remove-field-name="remove_thumbnail"
                            />
                        </div>
                        <div class="space-y-2">
                            <x-ui.label text="Status" />
                            <select name="is_published" class="w-full brutalist-input" required>
                                <option value="0" @selected((string) old('is_published', (int) $post->is_published) === '0')>Draft</option>
                                <option value="1" @selected((string) old('is_published', (int) $post->is_published) === '1')>Published</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <x-ui.label text="Description" />
                        <textarea name="description" rows="4" class="w-full brutalist-input">{{ old('description', $post->description) }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <x-ui.label text="Content" />
                        <x-ui.quileditor
                            name="content"
                            :value="old('content', $post->content)"
                            placeholder="Update your article content..."
                        />
                    </div>

                    <div class="space-y-3">
                        <x-ui.label text="Tags" />
                        @php($oldTags = old('tags', $post->tags ?? ['']))
                        <div id="tags-wrapper-edit" class="space-y-2">
                            @foreach ($oldTags as $tag)
                                <div class="flex items-center gap-2">
                                    <x-ui.input type="text" name="tags[]" :value="$tag" class="brutalist-input" placeholder="e.g. laravel" list="post-edit-tags-list" />
                                    <button type="button" class="brutalist-btn tag-remove-btn">Delete</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-tag-edit" class="brutalist-btn">+ Add Tag</button>
                    </div>
                    <datalist id="post-edit-tags-list">
                        @foreach ($tagsOptions as $tagOption)
                            <option value="{{ $tagOption }}"></option>
                        @endforeach
                    </datalist>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="brutalist-border p-4">
                            <p class="font-mono text-[10px] uppercase opacity-60">Created At</p>
                            <p class="font-black uppercase">{{ $post->created_at?->format('d M Y H:i') }}</p>
                        </div>
                        <div class="brutalist-border p-4">
                            <p class="font-mono text-[10px] uppercase opacity-60">Updated At</p>
                            <p class="font-black uppercase">{{ $post->updated_at?->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('writer.posts.priview', $post) }}" class="brutalist-btn text-center">Back</a>
                        <button type="submit" class="brutalist-btn-black">Update Post</button>
                    </div>
                </form>
            </main>
            @include('components.writer.profile-aside')
        </div>

        <x-ui.dialog
            id="writer-with-ai-dialog"
            title="Writer with AI"
            description="Generate draft untuk Title / Description / Content dari konfigurasi AI kamu."
        >
            <div class="space-y-6">
                <div>
                    <x-ui.label
                        for="writer-ai-configuration-select"
                        text="AI Model"
                        class="brutalist-label text-zinc-950 dark:text-zinc-50"
                    />
                    <select
                        id="writer-ai-configuration-select"
                        class="brutalist-input h-[54px] w-full appearance-none cursor-pointer dark:bg-transparent"
                    >
                        <option value="">Loading configurations...</option>
                    </select>

                    <p id="writer-ai-no-config" class="font-mono text-[10px] uppercase opacity-60 mt-2 hidden">
                        Belum ada konfigurasi AI yang aktif. Silakan buat di menu <span class="font-black">AI Configurations</span>.
                    </p>
                </div>

                <div>
                    <x-ui.label for="writer-ai-prompt" text="Instruction / Topic" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                    <textarea
                        id="writer-ai-prompt"
                        rows="5"
                        maxlength="4000"
                        class="w-full brutalist-input dark:bg-transparent"
                        placeholder="Contoh: Buat draft artikel tentang 'Laravel Queue untuk pemula' dengan gaya penjelasan yang praktis."
                    ></textarea>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button
                        type="button"
                        id="writer-ai-generate-btn"
                        class="border-2 border-zinc-900 dark:border-zinc-300 bg-zinc-950 text-zinc-50 dark:bg-zinc-100 dark:text-zinc-950 px-6 py-3 uppercase font-black text-xs tracking-[0.2em] transition-colors disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        Generate Draft
                    </button>
                    <button type="button" class="border-2 border-zinc-900 dark:border-zinc-300 px-6 py-3 uppercase font-black text-xs tracking-[0.2em]" data-dialog-close>
                        Close
                    </button>
                </div>

                <div>
                    <x-ui.label for="writer-ai-output" text="Output (copy/paste jika perlu)" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                    <textarea
                        id="writer-ai-output"
                        rows="8"
                        class="w-full brutalist-input dark:bg-transparent font-mono text-xs"
                        readonly
                    ></textarea>
                </div>
                <div id="writer-ai-thumbnail-preview-wrap" class="hidden space-y-2">
                    <x-ui.label for="writer-ai-thumbnail-preview" text="Preview Thumbnail AI" class="brutalist-label text-zinc-950 dark:text-zinc-50" />
                    <img
                        id="writer-ai-thumbnail-preview"
                        class="w-full max-h-56 object-cover border-2 border-zinc-900 dark:border-zinc-300"
                        alt="AI thumbnail preview"
                    >
                </div>

                <div class="flex flex-wrap gap-3">
                    <button
                        type="button"
                        id="writer-ai-apply-btn"
                        class="border-2 border-zinc-900 dark:border-zinc-300 px-6 py-3 uppercase font-black text-xs tracking-[0.2em] disabled:opacity-60 disabled:cursor-not-allowed"
                        disabled
                    >
                        Isi Sekarang
                    </button>
                </div>

                <div id="writer-ai-error" class="hidden p-4 brutalist-border bg-red-50 dark:bg-red-950 text-red-900 dark:text-red-100 font-mono text-xs whitespace-pre-wrap" role="alert"></div>
            </div>
        </x-ui.dialog>
    </div>
</body>
</html>
