<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as F;

class File extends Model
{
    use HasFactory;
    public function fileName(){
        $array=explode('@',$this->file);
        return $array[1];
    }
    public function filePath(){
        return asset('imports/'.$this->file);
    }
    public function teams(){
        return $this->belongsToMany(Team::class, 'file_team')->withPivot('team_id'); // 'user_role' is the pivot table name
    }
    public function fileData(){
        return $this->hasMany(FileData::class);
    }
    public function ip(){
        return $this->hasMany(InspectionPoint::class);
    }

}
