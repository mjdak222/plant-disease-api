<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
    ];

    // العلاقة مع المستخدم (الأدمن)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع التعليقات
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // العلاقة مع اللايكات
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
