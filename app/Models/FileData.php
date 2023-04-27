<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileData extends Model
{
    use HasFactory;
    public function getMeterNo(){
        return substr($this->meter,strlen($this->meter)-10,strlen($this->meter)-2);
    }
}
