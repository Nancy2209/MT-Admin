<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;
    protected $table = 'gallery_type';
    protected $fillable = ['name'];

    public function gallery()
    {
        return $this->hasMany('\App\Models\Gallary');
    }
}
