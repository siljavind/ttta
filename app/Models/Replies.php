<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    use HasFactory;
    protected $table = 'replies';
    protected $fillable = [
        'value',
        'question_id',
    ];

    protected static function boot()
    {
        parent::boot();
    }
}
