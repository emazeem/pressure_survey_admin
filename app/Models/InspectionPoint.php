<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionPoint extends Model
{
    use HasFactory;
    public function meter(){
        return $this->hasMany(FileData::class);
    }
}
