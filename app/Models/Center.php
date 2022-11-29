<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $fillable = ['state_id', 'city_id', 'name', 'code', 'mobile', 'email', 'address', 'address1', 'zip_code'];

    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }

    public function city()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
}
