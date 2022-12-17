<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportLayoutColumn extends Model
{
    use HasFactory,SoftDeletes;

    protected $table ='report_layout_columns';

    protected $primaryKey = 'id';

    protected  $fillable= [
        'report_id',
        'layout_id',
        'layout_name',
        'report_name',
        'column_name',
        'column_number'
    ];

    protected $guarded = [];
}
