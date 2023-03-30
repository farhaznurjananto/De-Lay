<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function forum_category()
    {
        return $this->belongsTo(Forum_Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
