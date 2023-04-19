<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public function members(){
        return $this->hasMany(Member::class);
    }
    public function files()
    {
        return $this->belongsToMany(File::class, 'file_team')->withPivot('file_id'); // 'user_role' is the pivot table name
    }

}
