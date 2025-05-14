<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    use HasFactory;
    protected $fillable = [
        'title',        // ✅ thêm dòng này
        'description',  // ✅ nếu có field description thì cũng thêm vào
        'course_id',    // ✅ nếu có course_id nữa thì thêm vào
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
