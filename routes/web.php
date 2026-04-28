<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Writer\AiConfigurationController;
use App\Http\Controllers\Writer\PostController;
use App\Http\Controllers\Writer\ProfileController;
use App\Models\CommentList;
use App\Models\FollowerList;
use App\Models\LikeList;
use App\Models\Post;
use App\Models\User;
use App\Models\ViewList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    $latestTransmissions = Post::query()
        ->where('is_published', true)
        ->latest()
        ->limit(3)
        ->get()
        ->map(function (Post $post): array {
            return [
                'image' => $post->thumbnail ? asset('storage/'.$post->thumbnail) : 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=800',
                'imageAlt' => $post->title,
                'fileRef' => 'ART_'.str_pad((string) $post->id, 3, '0', STR_PAD_LEFT),
                'title' => $post->title,
                'author' => $post->author,
                'date' => $post->created_at?->format('m.d.y') ?? now()->format('m.d.y'),
                'slug' => $post->slug,
                'href' => url('/articles/'.$post->slug),
            ];
        })
        ->all();

    return view('welcome', [
        'latestTransmissions' => $latestTransmissions,
    ]);
});

Route::get('/explore', function () {
    return view('explore');
});

Route::get('/authors', function () {
    $writers = User::query()
        ->withCount('posts')
        ->whereRaw("replace(lower(role), '-', '_') = ?", ['writer'])
        ->latest()
        ->get();

    return view('authors', [
        'writers' => $writers,
    ]);
})->name('authors');

Route::get('/authors/{user}', function (Request $request, User $user) {
    abort_unless($user->normalizedRole() === User::ROLE_WRITER, 404);

    $allPostIds = Post::query()
        ->where('user_id', $user->id)
        ->pluck('id');
    $publishedPosts = Post::query()
        ->where('user_id', $user->id)
        ->where('is_published', true)
        ->latest()
        ->get();
    $totalPosts = $allPostIds->count();
    $followersCount = FollowerList::query()
        ->where('author_id', $user->id)
        ->count();
    $followingCount = FollowerList::query()
        ->where('follower_id', $user->id)
        ->count();
    $totalViews = $allPostIds->isEmpty()
        ? 0
        : ViewList::query()->whereIn('post_id', $allPostIds)->count();
    $totalLikes = $allPostIds->isEmpty()
        ? 0
        : LikeList::query()->whereIn('post_id', $allPostIds)->count();
    $isFollowingWriter = $request->user()
        ? FollowerList::query()
            ->where('author_id', $user->id)
            ->where('follower_id', $request->user()->id)
            ->exists()
        : false;

    return view('author-detail', [
        'writer' => $user,
        'publishedPosts' => $publishedPosts,
        'followersCount' => $followersCount,
        'followingCount' => $followingCount,
        'totalViews' => $totalViews,
        'totalLikes' => $totalLikes,
        'totalPosts' => $totalPosts,
        'isFollowingWriter' => $isFollowingWriter,
    ]);
})->name('authors.show');

Route::post('/authors/{user}/follow', function (Request $request, User $user) {
    abort_unless($user->normalizedRole() === User::ROLE_WRITER, 404);

    if ($request->user()->id === $user->id) {
        return back()->with('error', 'Kamu tidak bisa follow akun sendiri.');
    }

    FollowerList::query()->firstOrCreate([
        'follower_id' => $request->user()->id,
        'author_id' => $user->id,
    ]);

    return back()->with('success', 'Sekarang kamu mengikuti author ini.');
})->middleware('auth')->name('authors.follow');

Route::get('/search', function () {
    return view('search');
});

Route::view('/changelog', 'changelog');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');

Route::post('/articles/{slug}/follow', function (Request $request, string $slug) {
    $post = Post::query()
        ->where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    if ($post->user_id === $request->user()->id) {
        return back()->with('error', 'Kamu tidak bisa follow akun sendiri.');
    }

    FollowerList::query()->firstOrCreate([
        'follower_id' => $request->user()->id,
        'author_id' => $post->user_id,
    ]);

    return back()->with('success', 'Sekarang kamu mengikuti author ini.');
})->middleware('auth')->name('articles.follow');

Route::post('/articles/{slug}/like', function (Request $request, string $slug) {
    $post = Post::query()
        ->where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    $existingLike = LikeList::query()
        ->where('post_id', $post->id)
        ->where('user_id', $request->user()->id)
        ->first();

    if ($existingLike) {
        $existingLike->delete();

        return back()->with('success', 'Like dihapus.');
    }

    LikeList::query()->create([
        'post_id' => $post->id,
        'user_id' => $request->user()->id,
    ]);

    return back()->with('success', 'Artikel disukai.');
})->middleware('auth')->name('articles.like');

Route::post('/articles/{slug}/comments', function (Request $request, string $slug) {
    $post = Post::query()
        ->where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    $validated = $request->validate([
        'comment' => ['required', 'string', 'max:2000'],
    ]);

    CommentList::query()->create([
        'post_id' => $post->id,
        'user_id' => $request->user()->id,
        'comment' => $validated['comment'],
    ]);

    return back()->with('success', 'Komentar berhasil ditambahkan.');
})->middleware('auth')->name('articles.comments.store');

Route::middleware('auth')->group(function () {
    Route::middleware('role:super_admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard.index');
        })->name('dashboard');
    });

    Route::middleware('role:writer')->group(function () {
        Route::get('/writer', function () {
            return view('writer.index');
        })->name('writer.home');

        Route::get('/writer/posts', [PostController::class, 'index'])->name('writer.posts');
        Route::get('/writer/posts/create', [PostController::class, 'create'])->name('writer.posts.create');
        Route::post('/writer/posts', [PostController::class, 'store'])->name('writer.posts.store');
        Route::get('/writer/posts/{post}/priview', [PostController::class, 'priview'])->name('writer.posts.priview');
        Route::get('/writer/posts/{post}/edit', [PostController::class, 'edit'])->name('writer.posts.edit');
        Route::put('/writer/posts/{post}', [PostController::class, 'update'])->name('writer.posts.update');
        Route::delete('/writer/posts/{post}', [PostController::class, 'destroy'])->name('writer.posts.destroy');

        Route::get('/writer/followers', function (Request $request) {
            $authorId = $request->user()->id;
            $authorPostIds = Post::query()->where('user_id', $authorId)->pluck('id');

            $networkFollowers = FollowerList::query()
                ->with('follower')
                ->where('author_id', $authorId)
                ->latest()
                ->paginate(9)
                ->through(function (FollowerList $followerRow) use ($authorPostIds): array {
                    $followerUser = $followerRow->follower;
                    $postsRead = $authorPostIds->isEmpty()
                        ? 0
                        : ViewList::query()
                            ->where('user_id', $followerUser?->id)
                            ->whereIn('post_id', $authorPostIds)
                            ->count();
                    $likesGiven = $authorPostIds->isEmpty()
                        ? 0
                        : LikeList::query()
                            ->where('user_id', $followerUser?->id)
                            ->whereIn('post_id', $authorPostIds)
                            ->count();

                    return [
                        'name' => $followerUser?->name ?? 'Anonymous',
                        'avatar' => $followerUser?->avatar_path
                            ? asset('storage/'.$followerUser->avatar_path)
                            : 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=160',
                        'badge' => $followerUser?->role ? str_replace('_', ' ', strtoupper($followerUser->role)) : 'MEMBER',
                        'meta' => 'Joined '.strtoupper($followerUser?->created_at?->format('M Y') ?? 'N/A').' • '.($followerUser?->role ? str_replace('_', ' ', strtoupper($followerUser->role)) : 'MEMBER'),
                        'engagement' => number_format((float) (($likesGiven / max(1, $authorPostIds->count())) * 100), 0).'%',
                        'read' => (string) $postsRead,
                    ];
                })
                ->withQueryString();

            return view('writer.followers', [
                'activeNav' => 'followers',
                'networkFollowers' => $networkFollowers,
            ]);
        })->name('writer.followers');

        Route::get('/writer/following', function () {
            return view('writer.following', ['activeNav' => 'following']);
        })->name('writer.following');

        Route::get('/writer/comments', function (Request $request) {
            $comments = CommentList::query()
                ->with(['post', 'user'])
                ->whereHas('post', fn ($query) => $query->where('user_id', $request->user()->id))
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return view('writer.comments', [
                'activeNav' => 'comments',
                'comments' => $comments,
            ]);
        })->name('writer.comments');

        Route::get('/writer/profile', [ProfileController::class, 'edit'])->name('writer.profile');
        Route::put('/writer/profile', [ProfileController::class, 'update'])->name('writer.profile.update');
        Route::get('/writer/ai-configurations', [AiConfigurationController::class, 'index'])->name('writer.ai-configurations');
        Route::post('/writer/ai-configurations', [AiConfigurationController::class, 'store'])->name('writer.ai-configurations.store');
        Route::put('/writer/ai-configurations/{aiConfiguration}', [AiConfigurationController::class, 'update'])->name('writer.ai-configurations.update');
        Route::delete('/writer/ai-configurations/{aiConfiguration}', [AiConfigurationController::class, 'destroy'])->name('writer.ai-configurations.destroy');
    });

    Route::middleware('role:reader')->group(function () {
        Route::get('/reader', function () {
            return view('reader.index');
        })->name('reader.home');
    });
});

Route::get('/articles/{slug}', function (Request $request, string $slug) {
    $post = Post::query()
        ->with('user')
        ->where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();
    $moreFromAuthor = Post::query()
        ->where('is_published', true)
        ->where('author', $post->author)
        ->where('id', '!=', $post->id)
        ->latest()
        ->limit(4)
        ->get()
        ->map(function (Post $related): array {
            return [
                'title' => $related->title,
                'description' => Str::limit((string) $related->description, 72),
                'ref' => 'ART_'.str_pad((string) $related->id, 3, '0', STR_PAD_LEFT),
                'href' => url('/articles/'.$related->slug),
            ];
        })
        ->all();

    if ($request->user()) {
        ViewList::query()->firstOrCreate([
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
        ]);
    }

    $pageTitle = $post->title;
    $tokens = preg_split('/\s+/', trim($pageTitle), -1, PREG_SPLIT_NO_EMPTY);
    $headlineLine1 = array_shift($tokens) ?: 'Raw';
    $headlineLine2 = $tokens ? implode(' ', $tokens) : 'Truths';
    $author = $post->user;
    $authorAvatar = $author?->avatar_path
        ? asset('storage/'.$author->avatar_path)
        : 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=600';
    $authorFollowers = $author
        ? FollowerList::query()->where('author_id', $author->id)->count()
        : 0;
    $isFollowingAuthor = $author && $request->user()
        ? FollowerList::query()
            ->where('author_id', $author->id)
            ->where('follower_id', $request->user()->id)
            ->exists()
        : false;
    $viewCount = ViewList::query()->where('post_id', $post->id)->count();
    $likeCount = LikeList::query()->where('post_id', $post->id)->count();
    $commentCount = CommentList::query()->where('post_id', $post->id)->count();
    $comments = CommentList::query()
        ->with('user')
        ->where('post_id', $post->id)
        ->latest()
        ->limit(20)
        ->get();
    $isLikedByUser = $request->user()
        ? LikeList::query()
            ->where('post_id', $post->id)
            ->where('user_id', $request->user()->id)
            ->exists()
        : false;

    return view('article', [
        'post' => $post,
        'slug' => $slug,
        'pageTitle' => $pageTitle,
        'headlineLine1' => $headlineLine1,
        'headlineLine2' => $headlineLine2,
        'articleRef' => 'ART_'.str_pad((string) $post->id, 3, '0', STR_PAD_LEFT),
        'moreFromAuthor' => $moreFromAuthor,
        'authorProfile' => [
            'name' => $post->author,
            'avatar' => $authorAvatar,
            'followers' => $authorFollowers,
        ],
        'isFollowingAuthor' => $isFollowingAuthor,
        'viewCount' => $viewCount,
        'likeCount' => $likeCount,
        'commentCount' => $commentCount,
        'comments' => $comments,
        'isLikedByUser' => $isLikedByUser,
    ]);
})->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*');
