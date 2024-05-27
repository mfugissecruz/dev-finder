<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @param  int  $id
 * @param  string  $name
 * @param  string  $email
 * @param  string  $role
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password'];

    /**
     * @return BelongsToMany<Developer>
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Developer::class, Favorite::class, 'user_id', 'developer_github_id');
    }

    public function role(): string
    {
        return match ($this->role) {
            'cto' => 'Chief Technology Officer',
            'default' => 'User',
        };
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
