<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_id',
        'status',
        // Add any other fillable fields here
    ];
}
