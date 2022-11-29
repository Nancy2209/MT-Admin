<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['quarter_name', 'quarter_code', 'file_name', 'report_category_id', 'report_year'];

    public function category()
    {
        return $this->hasOne('\App\Models\ReportCategory', 'id', 'report_category_id');
    }
}
