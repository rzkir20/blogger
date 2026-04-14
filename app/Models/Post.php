<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'category_id',
    'title',
    'slug',
    'category',
    'author',
    'description',
    'content',
    'tags',
    'is_published',
    'thumbnail',
])]
class Post extends Model
{
    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoryRelation(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tagsRelation(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag')->withTimestamps();
    }

    public function viewList(): HasMany
    {
        return $this->hasMany(ViewList::class, 'post_id');
    }

    public function likeList(): HasMany
    {
        return $this->hasMany(LikeList::class, 'post_id');
    }

    public function commentsList(): HasMany
    {
        return $this->hasMany(CommentList::class, 'post_id');
    }
}
