<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'tag_id', 'image_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }


    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
