<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'content',
        'status',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }








    public function scopePublishedLast30Days($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '>=', now()->subDays(30));
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getPublishedAtFormattedAttribute()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y H:i') : null;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}