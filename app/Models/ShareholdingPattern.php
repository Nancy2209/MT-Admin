<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareholdingPattern extends Model
{
    use HasFactory;
    protected $fillable = ['file_name','file_title','pattern_code','quarter_name'];
}
