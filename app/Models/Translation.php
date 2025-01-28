<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{

    use HasFactory;
    protected $fillable = ['locale', 'key', 'value', 'tag'];

    public function scopeTag($query, $tag)
    {
        return $query->where('tag', $tag);
    }

    public function scopeKey($query, $key)
    {
        return $query->where('key', 'LIKE', "%$key%");
    }

    public function scopeContent($query, $content)
    {
        return $query->where('value', 'LIKE', "%$content%");
    }
}
