<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorPresentation extends Model
{
    use HasFactory;
    protected $fillable = ['file_name', 'quarter_name', 'quarter_code', 'invest_year'];
}
