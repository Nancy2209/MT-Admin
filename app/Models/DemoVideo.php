<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemoVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id', 'title', 'video_url', 'video_name', 'description', 'tag_name'
    ];

    public function classCategory()
    {
        return $this->hasOne('\App\Models\ClassCategory', 'id', 'class_id');
    }
}
