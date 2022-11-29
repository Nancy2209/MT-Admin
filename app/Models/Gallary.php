<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Gallary extends Authenticatable
{
    protected $table = 'gallary';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'category_id'
    ];

    public function category()
    {
        return $this->hasOne('\App\Models\GalleryCategory', 'id', 'category_id');
    }
}
