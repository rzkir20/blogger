<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post | Writer Dashboard</title>
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
                    <p class="font-mono text-xs uppercase font-black tracking-widest opacity-60">Posts / Create</p>
                    <h1 class="font-black text-5xl sm:text-6xl tracking-tighter uppercase">Create Article</h1>
                </section>

                @if ($errors->any())
                    <div class="p-4 brutalist-border bg-red-50 dark:bg-red-950 text-red-900 dark:text-red-100 font-mono text-xs uppercase" role="alert">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="writer-post-create-form" method="post" action="{{ route('writer.posts.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <x-ui.label text="Title" />
                            <x-ui.input type="text" name="title" :value="old('title')" class="brutalist-input" required />
                        </div>
                        
                        <div class="space-y-2">
                            <x-ui.label text="Category" />
                            <x-ui.input type="text" name="category" :value="old('category')" class="brutalist-input" list="post-create-categories-list" required />
                            <datalist id="post-create-categories-list">
                                @foreach ($categories as $categoryOption)
                                    <option value="{{ $categoryOption }}"></option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="space-y-2">
                            <x-ui.label text="Author" />
                            <x-ui.input type="text" name="author" :value="old('author', $authorName)" class="brutalist-input" required readonly />
                        </div>

                        <div class="space-y-2">
                            <x-ui.label text="Status" />
                            <select name="is_published" class="w-full brutalist-input" required>
                                <option value="0" @selected(old('is_published', '0') === '0')>Draft</option>
                                <option value="1" @selected(old('is_published') === '1')>Published</option>
                            </select>
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <x-ui.label text="Description" />
                            <textarea name="description" rows="4" class="w-full brutalist-input">{{ old('description') }}</textarea>
                        </div>
    

                        <div class="space-y-2 md:col-span-2">
                            <x-ui.label text="Thumbnail" />
                            <x-ui.file
                                name="thumbnail"
                                id-prefix="post-create-thumbnail"
                                accept="image/*,.avif"
                                drop-text="Drop thumbnail here or click to browse"
                                helper-text="Recommended: landscape image for article card"
                                upload-button-text="Upload Thumbnail"
                                remove-button-text="Remove Thumbnail"
                                remove-field-name="remove_thumbnail"
                            />
                        </div>
                    </div>

                 
                    <div class="space-y-2">
                        <x-ui.label text="Content" />
                        <x-ui.quileditor
                            name="content"
                            :value="old('content')"
                            placeholder="Write the full article content..."
                        />
                    </div>

                    <div class="space-y-3">
                        <x-ui.label text="Tags" />
                        @php($oldTags = old('tags', ['']))
                        <div id="tags-wrapper-create" class="space-y-2">
                            @foreach ($oldTags as $tag)
                                <div class="flex items-center gap-2">
                                    <x-ui.input type="text" name="tags[]" :value="$tag" class="brutalist-input" placeholder="e.g. laravel" list="post-create-tags-list" />
                                    <button type="button" class="brutalist-btn tag-remove-btn">Delete</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-tag-create" class="brutalist-btn">+ Add Tag</button>
                    </div>
                    <datalist id="post-create-tags-list">
                        @foreach ($tagsOptions as $tagOption)
                            <option value="{{ $tagOption }}"></option>
                        @endforeach
                    </datalist>

                    <div class="flex gap-4">
                        <a href="{{ route('writer.posts') }}" class="brutalist-btn text-center">Back</a>
                        <button type="submit" class="brutalist-btn-black">Save Post</button>
                    </div>
                </form>
            </main>

            @include('components.writer.profile-aside')
        </div>
    </div>
</body>
</html>
