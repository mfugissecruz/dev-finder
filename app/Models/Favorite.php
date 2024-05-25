<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $developer_id
 */
class Favorite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'developer_id'];

    /**
     * Get the developer that is favorited.
     *
     * @return BelongsTo<Developer, Favorite>
     */
    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }
}
