<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $fillable = ['country_id', 'name', 'email', 'password'];

    public function country()    { return $this->belongsTo(Country::class); }
    public function profile()    { return $this->hasOne(Profile::class); }
    public function posts()      { return $this->hasMany(Post::class); }
    public function videos()     { return $this->hasMany(Video::class); }
    public function comments()   { return $this->hasMany(Comment::class); }
    public function likedPosts() { return $this->belongsToMany(Post::class, 'likes')->withTimestamps(); }
}

