<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'slug', 'excerpt', 'body', 'cover_image', 'status', 'published_at'];
    protected $casts = ['published_at' => 'datetime'];

    public function user()     { return $this->belongsTo(User::class); }
    public function comments() { return $this->morphMany(Comment::class, 'commentable'); }
    public function tags()     { return $this->morphToMany(Tag::class, 'taggable'); }
    public function likers()   { return $this->belongsToMany(User::class, 'likes')->withTimestamps(); }
    public function scopePublished($query) { return $query->where('status', 'published'); }
}