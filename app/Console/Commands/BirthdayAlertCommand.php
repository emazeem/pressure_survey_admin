<?php

namespace App\Console\Commands;

use App\Models\License;
use App\Models\LicenseExpireAlerts;
use App\Models\User;
use Illuminate\Console\Command;

class BirthdayAlertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Birthday alert for NP Social users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $user=User::where('role',3)->get();
        foreach ($user as $u){
            $dob=explode('-',$u->details->date_of_birth);
            $dob[0]=date('Y');
            $dob=implode('-',$dob);
            $fdate = $dob;
            $tdate = date('Y-m-d');
            $datetime1 = strtotime($fdate); // convert to timestamps
            $datetime2 = strtotime($tdate); // convert to timestamps
            $days = (int)(($datetime1 - $datetime2)/86400);
            if($days==0){
                a_notification_without_db($u->id,'Happy Birthday',['data'=>null,'url'=>null]);
            }
        }
        return 0;

    }
}
