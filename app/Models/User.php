<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property boolean is_admin
 * @property string $bio
 * @property string $email
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class)->latest();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'follower_user',
            'follower_id',
            'user_id'
        )->withTimestamps();
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'follower_user',
            'user_id',
            'follower_id'
        )->withTimestamps();
    }

    public function follows(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Idea::class, 'idea_like')->withTimestamps();
    }

    public function likesPost(Idea $idea)
    {
        return $this->likes()->where('idea_id', $idea->id)->exists();
    }

    public function getImageURL()
    {
        if ($this->image) {
            return url("storage/$this->image");
        }

        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed=$this->name";
    }
}
