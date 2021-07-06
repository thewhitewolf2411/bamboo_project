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
            "2", "4", "4b", "6", "7", "8a", "8b", "8c", "8d", "8e", "8f", "9", "9a", "10", "11", "11a", "11b", "11c", "11d", "11e", "11f","11g", "11h",
            "11i", "11j", "12", "13", "14", "15", "15a", "15b", "15c", "15d", "15e", "15f", "15g", "15h", "15i", "15j", "16", "17",
        ];
        $jobstates = JobStateChanged::whereIn('job_state', $triggercustomermailstates)->where('sent', false)->where('updated_at', '<=', \Carbon\Carbon::now()->subHour()->toDateTimeString())->get();

        foreach($jobstates as $jobstate){

            $emailTradein = $jobstate->getTradein();
            $emailUser = $jobstate->getUser();
            $klaviyoemail = new KlaviyoEmail();
            $notificationservice = new NotificationService();

            #dd(\Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()));

            switch($emailTradein->job_state){
                case "2":
                    if(\Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) > 7 && \Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) < 10){
                        $tradeins = $jobstate->getTradeinsByBarcode();
                        $klaviyoemail->orderExpiresInSevenDays($emailUser, $tradeins);
                        foreach($tradeins as $tradein){
                            $notificationService = new NotificationService();
                            $notificationService->sendNotReceivedYet($tradein);
                        }
                        //$jobstate->sent = true;
                        break;
                    }
                    if(\Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) > 10 && \Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) < 14){
                        $tradeins = $jobstate->getTradeinsByBarcode();
                        $klaviyoemail->orderExpiresInFourDays($emailUser, $tradeins);
                        foreach($tradeins as $tradein){
                            $notificationService = new NotificationService();
                            $notificationService->sendNotReceivedYet($tradein);
                        }
                        //$jobstate->sent = true;
                        break;
                    }
                    if(\Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) > 14 && \Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) < 21){
                        $tradeins = $jobstate->getTradeinsByBarcode();
                        $klaviyoemail->orderExpired($emailUser, $tradeins);
                        foreach($tradeins as $tradein){
                            $notificationService = new NotificationService();
                            $notificationService->sendNotReceivedYet($tradein);
                        }
                        //$jobstate->sent = true;
                        break;
                    }
                    if(\Carbon\Carbon::parse($emailTradein->created_at)->diffInDays(\Carbon\Carbon::now()) > 21){
                        $tradeins = $jobstate->getTradeinsByBarcode();
                        $klaviyoemail->orderNeverReceived($emailUser, $tradeins);
                        //$jobstate->sent = true;
                        break;
                    }
                    break;
                case "4":
                    $tradeins = $jobstate->getTradeinsByBarcode();
                    $klaviyoemail->deviceMissing_testing_em_5($emailUser, $tradeins[0]);
                    $notificationservice->sendMissingDevice($emailTradein);
                    $jobstate->sent = true;
                    break;
                case "6":
                    $klaviyoemail->noImei_testing_em_3($emailUser, $emailTradein);
                    $notificationservice->sendNoIMEI($emailTradein);
                    $jobstate->sent = true;
                    break;
                case "8a":
                    $klaviyoemail->device_lost_post_testing_em_4($emailUser, $emailTradein);
                    $notificationservice->sendBlacklisted($emailTradein);
                    $jobstate->sent = true;
                    break;
                case "8b":
                    $klaviyoemail->device_lost_post_testing_em_4($emailUser, $emailTradein);
                    $notificationservice->sendBlacklisted($emailTradein);
                    $jobstate->sent = true;
                    break;
                case "8d":
                    $klaviyoemail->device_lost_post_testing_em_4($emailUser, $emailTradein);
                    $notificationservice->sendBlacklisted($emailTradein);
                    $jobstate->sent = true;
                    break;
                case "8c":
                case "8e":
                    $klaviyoemail->device_lost_post_testing_em_4($emailUser, $emailTradein);
                    $notificationservice->sendBlacklisted($emailTradein);
                    $jobstate->sent = true;
                    break;
                case "8f":
                    $klaviyoemail->asset_watch_post_testing_em_5($emailUser, $emailTradein);
                    $notificationservice->sendBlacklisted($emailTradein);
                    $jobstate->sent = true;
                    break;
                case "11a":
                case "15a":
                    $klaviyoemail->FMIP_testing_em_4($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Find My iPhone still active.'
                    );
                    $jobstate->sent = true;
                    break;
                case "11b":
                case "15b":
                    $klaviyoemail->Google_testing_em_4($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Google Activation Lock still active.'
                    );
                    $jobstate->sent = true;
                    break;
                case "11c":
                case "15c":
                    $klaviyoemail->pinLocked_testing_em_4($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Pin Lock still active.'
                    );
                    $jobstate->sent = true;
                    break;
                case "11d":
                case "15d":
                    $klaviyoemail->noImei_testing_em_3($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device model incorrect.'
                    );
                    $jobstate->sent = true;
                    break;
                case "11e":
                case "15e":
                    $klaviyoemail->noImei_testing_em_3($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device does not meet the following requirements. Reason: Downgrade.'
                    );
                    $jobstate->sent = true;
                    break;
                case "11f":
                case "15f":
                    $klaviyoemail->noImei_testing_em_3($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device memory incorrect.'
                    );
                    $jobstate->sent = true;
                    break;
                case "11g":
                case "15g":
                    $klaviyoemail->noImei_testing_em_3($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device network is incorrect.'
                    );
                    $jobstate->sent = true;
                    break;
                case "11h":
                case "15h":
                    $klaviyoemail->noImei_testing_em_3($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device does not meet the following requirements. Reason: Device has water damage.'
                    );
                    $jobstate->sent = true;
                    break;
                case "11i":
                case "15i":
                    $klaviyoemail->noImei_testing_em_3($emailUser, $emailTradein);
                    $notificationservice->sendTestingFailed(
                        $emailTradein,
                        'Device does not meet the following requirements. Reason: Downgrade.'
                    );
                    $jobstate->sent = true;
                    break;
                //case "11j":
                //case "15j":
                //    $klaviyoemail->downgraded($emailUser, $emailTradein);
                //    $notificationservice->sendTestingFailed(
                //        $emailTradein,
                //        'Device does not meet the following requirements. Reason: Downgrade.'
                //    );
                //    break;
            }

            $jobstate->save();
        }


        $expirycustomerstates = ["4"];
        $jobstates = JobStateChanged::whereIn('job_state', $expirycustomerstates)->get();

        foreach($jobstates as $jobstate){
            $emailTradein = $jobstate->getTradein();
            switch($emailTradein->job_state){
                case "4":
                    if(\Carbon\Carbon::parse($emailTradein->updated_at)->diffInDays(\Carbon\Carbon::now()) > 28){
                        $emailTradein->job_state = '4b';
                        $emailTradein->save();

                    }
                break;
            }
        }
    }
}
