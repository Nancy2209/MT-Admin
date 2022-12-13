<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;
    protected $fillable = ['page_name', 'mata_title', 'mata_keyboard', 'mata_description', 'canonical_tag'];
}
