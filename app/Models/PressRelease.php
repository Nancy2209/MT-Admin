<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressRelease extends Model
{
    use HasFactory;
    protected $fillable = ['release_category_id', 'file_name', 'file_title', 'date', 'invest_quater'];

    public function category()
    {
        return $this->hasOne('\App\Models\ReleaseCategory', 'id', 'release_category_id');
    }
}
