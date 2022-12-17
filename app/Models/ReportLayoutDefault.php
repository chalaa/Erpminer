<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportLayoutDefault extends Model
{
    use HasFactory;

    protected $table ='report_layout_defaults';

    protected $primaryKey = 'id';

    protected $fillable = [
        'report_id',
        'layout_id',
        'user_id',
        'layout_name',
        'report_name'
    ];

    protected $guarded = [];

    public function report()
    {
        return $this->belongsTo(Report::class,'report_id','id');
    }

    public function layout()
    {
        return $this->belongsTo(ReportLayout::class,'layout_id','id');
    }
}
