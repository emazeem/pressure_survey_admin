<?php

namespace App\Console\Commands;

use App\Models\License;
use App\Models\LicenseExpireAlerts;
use Illuminate\Console\Command;

class LicenseAlertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'License renewals due users getting notified';

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
        $alerts=LicenseExpireAlerts::query()->select('days')->get();
        $expiryAlertDays=[];
        foreach ($alerts as $alert){
            $expiryAlertDays[]=$alert->days;
        }
        $licenses=License::all();

        foreach ($licenses as $license){
            $fdate = $license->expiry;
            $tdate = date('Y-m-d');
            $datetime1 = strtotime($fdate); // convert to timestamps
            $datetime2 = strtotime($tdate); // convert to timestamps
            $days = (int)(($datetime1 - $datetime2)/86400);
            if (in_array($days,$expiryAlertDays)){
                // send push notification to user
                a_notification_without_db($license->user_id,
                    'Dear '.$license->user->fname.' '.$license->user->lname.', your '.$license->title.' with '.$license->number.' is getting expired on '.$license->expiry.'. ',
                    ['data'=>null,'url'=>null]);
            }
        }
        return 0;
    }
}
