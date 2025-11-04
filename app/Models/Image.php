<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'file_name',
        'file_type',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
