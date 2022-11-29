<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id','title','description','tag_name','image'

    ];


    public function courseType()
    {
        return $this->hasOne('\App\Models\CourseType','id','course_id');
    }
}
