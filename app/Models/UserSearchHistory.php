<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSearchHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'keyword_id',
        'status',
        'search_keyword',
        'search_result_count',
        'search_timestamp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keyword()
    {
        return $this->belongsTo(Keyword::class);
    }
}
