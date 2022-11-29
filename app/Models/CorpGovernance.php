<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorpGovernance extends Model
{
    use HasFactory;
    protected $fillable = ['filename', 'file_title'];
}
