<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardsRecognition extends Model
{
    use HasFactory;
     protected $fillable = ['award_title','description','image'];
}
