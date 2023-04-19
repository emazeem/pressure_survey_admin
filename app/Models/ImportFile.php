<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImportFile extends Model
{
    use HasFactory;
    public function fileName(){
        $array=explode('@@',$this->file);
        return $array[1];
    }
    public function filePath(){
        return Storage::disk('local')->url('storage/imports/'.$this->file);
    }


    public function teams()
    {
        return $this->belongsToMany(Team::class, 'user_role'); // 'user_role' is the pivot table name
    }

}
