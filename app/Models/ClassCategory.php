<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'name', 'board_name'

    ];

    public function courseType()
    {
        return $this->hasOne('\App\Models\CourseType', 'id', 'course_id');
    }
}
