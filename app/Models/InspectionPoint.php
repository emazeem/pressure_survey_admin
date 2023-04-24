<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPoint extends Model
{
    use HasFactory;
    public function data(){
        return $this->hasMany(FileData::class,'ip_id','id');
    }
    public function images(){
        return $this->hasMany(IpImages::class,'ip_id','id');
    }

}
