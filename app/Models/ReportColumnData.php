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

    

    public function report()
    {
        return $this->belongsTo(Report::class,'report_id','id');
    }

    public function column()
    {
        return $this->belongsTo(ReportLayoutColumn::class,'column_id','id');
    }

    // public function scopeFilter($query, array $filters){
    //     if($filters['search'] ?? false){
    //         $query
    //     }
    // }
}
