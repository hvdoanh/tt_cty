<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{


    use HasFactory;


    protected $fillable = [
        'title',        // ✅ thêm dòng này
        'description',  // ✅ nếu có field description thì cũng thêm vào
        'user_id',      // ✅ nếu có user_id nữa thì thêm vào
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
