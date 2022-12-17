<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportColumnData extends Model
{
    use HasFactory;

    protected $table ='report_column_data';

    protected $fillable = [
        'report_id',
        'column_id',
        'column_data'
    ];

    protected $guarded = [];
}
