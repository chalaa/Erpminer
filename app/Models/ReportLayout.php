<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportLayout extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'id';
    protected $fillable = [
        'report_id', 
        'layout_name', 
        'report_name', 
        'description'
    ];

    protected $guarded = false;

    public function report()
    {
        return $this->belongsTo(Report::class,'report_id','id');
    }

    public function column()
    {
        return $this->hasMany(ReportLayoutColumn::class,'layout_id','id');
    }
    
    public function default(){
        return $this->hasMany(ReportLayoutDefault::class,'layout_id','id');
    }

}
