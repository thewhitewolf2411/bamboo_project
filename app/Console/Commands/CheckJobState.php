<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Eloquent\Tradein;
use App\Eloquent\JobStateChanged;
use App\Services\KlaviyoEmail;
use App\Services\NotificationService;

class CheckJobState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckJobState';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $triggercustomermailstates = [
            "4", "6", "7", "8a", "8b", "8c", "8d", "8e", "8f", "9", "9a", "10", "11", "11a", "11b", "11c", "11d", "11e", "11f","11g", "11h",
            "11i", "11j", "12", "13", "14", "15", "15a", "15b", "15c", "15d", "15e", "15f", "15g", "15h", "15i", "15j", "16", "17",
        ];
        $jobstates = JobStateChanged::whereIn('job_state', $triggercustomermailstates)->where('sent', false)->where('updated_at', '<=', \Carbon\Carbon::now()->subHour()->toDateTimeString())->get();

        foreach($jobstates as $jobstate){

            $emailTradein = $jobstate->getTradein();
            $emailUser = $jobstate->getUser();
            $klaviyoemail = new KlaviyoEmail();
            $notificationservice = new NotificationService();

            switch($emailTradein->job_state){
                case "4":
                    $klaviyoemail->missingDevice($emailUser);
                    $notificationservice->sendMissingDevice($emailTradein);
                    break;
                case "6":
                    $klaviyoemail->noImei($emailUser, $emailTradein);
                    $notificationservice->sendNoIMEI($emailTradein);
                    break;
                case "7":
                    $klaviyoemail->blacklisted($emailUser, $emailTradein);
                    $notificationservice->sendBlacklisted($emailTradein);
                    break;
                case "8a":
                    $klaviyoemail->cancellationNoReturn($emailUser);
                    $notificationservice->sendBlacklisted($emailTradein);
                    break;
                case "8b":
                    $klaviyoemail->deviceUnderContract($emailUser, $emailTradein);
                    $notificationservice->sendBlacklisted($emailTradein);
                    break;
                case "8d":
                    $klaviyoemail->deviceStolen($emailUser, $emailTradein);
                    $notificationservice->sendBlacklisted($emailTradein);
                    break;
                case "8c":
                case "8e":
                    $klaviyoemail->cancellationNoReturn($emailUser);
                    $notificationservice->sendBlacklisted($emailTradein);
                    break;
                case "11a":
                case "15a":
                    $klaviyoemail->FIMP($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Find My iPhone still active.'
                    );
                    break;
                case "11b":
                case "15b":
                    $klaviyoemail->googleLocked($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Google Activation Lock still active.'
                    );
                    break;
                    break;
                case "11c":
                case "15c":
                    $klaviyoemail->pinLocked($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Pattern/PIN number not provided.'
                    );
                    break;
                case "11d":
                case "15d":
                    $klaviyoemail->wrongDevice($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device model incorrect.'
                    );
                    break;
                case "11e":
                case "15e":
                    $klaviyoemail->downgraded($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device does not meet the following requirements. Reason: Downgrade.'
                    );
                    break;
                case "11f":
                case "15f":
                    $klaviyoemail->downgraded($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device memory incorrect.'
                    );
                    break;
                case "11g":
                case "15g":
                    $klaviyoemail->downgraded($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device network is incorrect.'
                    );
                    break;
                case "11h":
                case "15h":
                    $klaviyoemail->downgraded($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device does not meet the following requirements. Reason: Downgrade.'
                    );
                    break;
                case "11i":
                case "15i":
                    $klaviyoemail->downgraded($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device does not meet the following requirements. Reason: Downgrade.'
                    );
                    break;
                case "11j":
                case "15j":
                    $klaviyoemail->downgraded($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device does not meet the following requirements. Reason: Downgrade.'
                    );
                    break;
            }

        }
    }
}
