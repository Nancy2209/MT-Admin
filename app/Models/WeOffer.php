<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeOffer extends Model
{
    use HasFactory;

    protected $table = 'our_offers';

    protected $fillable = ['title', 'image', 'description', 'link_url'];
}
