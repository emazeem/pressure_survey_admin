<?php

namespace App\Http\Traits;

use App\Models\Journal;
use App\Models\JournalDetails;

trait Transaction
{
    public function transaction($type,$narration,$data){

        $journal=new Journal();
        $journal->type=$type;
        $journal->narration=$narration;
        $journal->trx=0;
        $journal->save();
        $journal->trx=str_pad($journal->id,4,0,STR_PAD_LEFT);
        $journal->save();
        foreach ($data as $datum) {
            $detail= new JournalDetails();
            $detail->journal_id=$journal->id;
            $detail->account=$datum['account'];
            $detail->dr=$datum['dr'];
            $detail->cr=$datum['cr'];
            $detail->save();
        } 
        return true;
    }
}