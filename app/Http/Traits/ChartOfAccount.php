<?php

namespace App\Http\Traits;


trait ChartOfAccount
{
    public function coa_create($name,$group){
        $coa=new \App\Models\ChartOfAccount();
        $coa->title=$name;
        $coa->group=$group;
        $coa->save();
        return $coa;
    }

}