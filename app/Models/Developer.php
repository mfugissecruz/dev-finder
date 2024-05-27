<?php

namespace App\Models;

use App\Contracts\Developer as DeveloperContract;
use App\Traits\DeveloperData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $github_id
 * @property string $login
 * @property string $name
 * @property string $node_id
 * @property string $avatar_url
 * @property string $github_url
 * @property string $email
 * @property string $blog
 * @property string $bio
 * @property string $company
 * @property string $location
 * @property int $public_repos
 * @property int $following
 * @property int $followers
 * @property string $github_created_at
 */
class Developer extends Model implements DeveloperContract
{
    use DeveloperData;
    use HasFactory;

    protected $appends = ['is_favorite'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'github_id',
        'name',
        'login',
        'node_id',
        'avatar_url',
        'github_url',
        'email',
        'blog',
        'bio',
        'company',
        'location',
        'public_repos',
        'following',
        'followers',
        'github_created_at',
    ];

    /**
     * Get the favorites for the developer.
     *
     * @return HasMany<Favorite>
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'developer_github_id', 'github_id');
    }

    /**
     * The users that belong to the developer.
     *
     * @return BelongsToMany<User>
     */
    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'developer_user', 'github_id', 'user_id');
    }

    /**
     * Determine if the developer is favorited by the authenticated user.
     */
    public function getIsFavoriteAttribute(): bool
    {
        if (! Auth::check()) {
            return false;
        }

        return $this->favorites()->where('user_id', Auth::id())->exists();
    }
}
