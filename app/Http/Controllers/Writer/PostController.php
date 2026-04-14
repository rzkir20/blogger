<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::query()
            ->whereBelongsTo($request->user())
            ->with(['categoryRelation', 'tagsRelation'])
            ->withCount(['viewList', 'likeList', 'commentsList'])
            ->latest()
            ->get();

        return view('writer.post', [
            'activeNav' => 'posts',
            'posts' => $posts,
        ]);
    }

    public function create(Request $request): View
    {
        return view('writer.post.create', [
            'activeNav' => 'posts',
            'authorName' => $request->user()?->name,
            'categories' => Category::query()->orderBy('name')->pluck('name'),
            'tagsOptions' => Tag::query()->orderBy('name')->pluck('name'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $category = $this->resolveCategory($validated['category']);
        $tags = $this->normalizeTags($validated['tags'] ?? []);

        $validated['user_id'] = $request->user()->id;
        $validated['slug'] = $this->generateUniquePostSlug($validated['title']);
        $validated['category_id'] = $category->id;
        $validated['category'] = $category->name;
        $validated['tags'] = $tags;

        $post = Post::create($validated);
        $post->tagsRelation()->sync($this->resolveTagIds($tags));

        ToastMagic::success('Post berhasil dibuat', 'Artikel baru sudah masuk ke arsip kamu.');

        return redirect()->route('writer.posts.priview', $post);
    }

    public function priview(Request $request, Post $post): View
    {
        abort_unless($post->user_id === $request->user()->id, 403);

        $post->loadCount(['viewList', 'likeList', 'commentsList']);

        return view('writer.post.priview', [
            'activeNav' => 'posts',
            'post' => $post,
        ]);
    }

    public function edit(Request $request, Post $post): View
    {
        abort_unless($post->user_id === $request->user()->id, 403);

        return view('writer.post.edit', [
            'activeNav' => 'posts',
            'post' => $post,
            'categories' => Category::query()->orderBy('name')->pluck('name'),
            'tagsOptions' => Tag::query()->orderBy('name')->pluck('name'),
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        abort_unless($post->user_id === $request->user()->id, 403);

        $validated = $this->validatePayload($request);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        } elseif ($request->boolean('remove_thumbnail')) {
            $validated['thumbnail'] = null;
        } else {
            $validated['thumbnail'] = $post->thumbnail;
        }

        $category = $this->resolveCategory($validated['category']);
        $tags = $this->normalizeTags($validated['tags'] ?? []);

        $validated['category_id'] = $category->id;
        $validated['slug'] = $this->generateUniquePostSlug($validated['title'], $post->id);
        $validated['category'] = $category->name;
        $validated['tags'] = $tags;

        $post->update($validated);
        $post->tagsRelation()->sync($this->resolveTagIds($tags));

        ToastMagic::success('Post berhasil diupdate', 'Perubahan artikel sudah disimpan.');

        return redirect()->route('writer.posts.priview', $post);
    }

    public function destroy(Request $request, Post $post): RedirectResponse
    {
        abort_unless($post->user_id === $request->user()->id, 403);

        $post->delete();

        ToastMagic::info('Post dihapus', 'Artikel sudah dihapus dari arsip.');

        return redirect()->route('writer.posts');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatePayload(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:3000'],
            'content' => ['required', 'string', 'max:50000'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'string', 'max:50'],
            'is_published' => ['required', 'boolean'],
            'thumbnail' => ['nullable', 'image', 'max:3072'],
            'remove_thumbnail' => ['nullable', 'boolean'],
        ]);
    }

    /**
     * @param  array<int, mixed>  $tags
     * @return array<int, string>
     */
    private function normalizeTags(array $tags): array
    {
        $normalized = collect($tags)
            ->map(fn (mixed $tag): string => Str::of((string) $tag)->trim()->toString())
            ->filter()
            ->unique(fn (string $tag): string => Str::lower($tag))
            ->values()
            ->all();

        return Arr::map($normalized, fn (string $tag): string => $tag);
    }

    /**
     * @param  array<int, string>  $tags
     * @return array<int, int>
     */
    private function resolveTagIds(array $tags): array
    {
        $tagIds = [];

        foreach ($tags as $tagName) {
            $slug = Str::slug($tagName);
            if ($slug === '') {
                $slug = 'tag';
            }
            $tag = Tag::query()->firstOrCreate(
                ['slug' => $slug],
                ['name' => $tagName]
            );
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }

    private function resolveCategory(string $name): Category
    {
        $slug = Str::slug($name);
        if ($slug === '') {
            $slug = 'category';
        }

        return Category::query()->firstOrCreate(
            ['slug' => $slug],
            ['name' => $name]
        );
    }

    private function generateUniquePostSlug(string $title, ?int $ignorePostId = null): string
    {
        $baseSlug = Str::slug($title);
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'post';
        $slug = $baseSlug;
        $counter = 2;

        while (
            Post::query()
                ->where('slug', $slug)
                ->when($ignorePostId, fn ($query) => $query->where('id', '!=', $ignorePostId))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
