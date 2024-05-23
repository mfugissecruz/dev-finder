<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $github_id
 * @property string $login
 * @property string $name
 * @property string $email
 * @property string $blog
 * @property string $location
 * @property string $avatar_url
 * @property string $bio
 * @property int $public_repos
 * @property int $followers
 * @property int $following
 */
class Developer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'github_id',
        'login',
        'name',
        'email',
        'blog',
        'location',
        'avatar_url',
        'bio',
        'public_repos',
        'followers',
        'following',
    ];
}
