<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedProfile extends Model
{
    use HasFactory;

    protected $fillable = ['developer_id', 'user_id', 'shared_by'];
}
