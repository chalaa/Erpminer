<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'report_name',
        'description',
        'file_name',
        'location',
        'column_number'
    ];

    protected $guarded = [];

    public function layout(){
        return $this->hasMany(ReportLayout::class,'report_id','id');
    }

    public function column(){
        return $this->hasMany(ReportLayoutColumn::class,'report_id','id');
    }

    public function default(){
        return $this->hasOne(ReportLayoutDefault::class,'report_id','id');
    }

    public function columnData(){
        return $this->hasMany(ReportColumnData::class,'report_id','id');
    }
}
