<?php

namespace App\Console\Commands;

use App\Eloquent\Payment\BatchDeviceEmail;
use App\Eloquent\Payment\PaymentBatchDevice;
use App\Eloquent\Tradein;
use App\Services\KlaviyoEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for failed payments (handle sending emails)';

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

        $now = Carbon::now();
        $klaviyo = new KlaviyoEmail();
        $failed_payment_devices = PaymentBatchDevice::where('payment_state', 2)->get();
        foreach($failed_payment_devices as $device){
            $failed_mails = BatchDeviceEmail::where('batch_device_id', $device->id)->get();

            switch ($failed_mails->count()) {
                case 1:
                    // first failed payment mail sent, send second if 72 hours passed
                    $created_at = $failed_mails->first()->created_at;
                    $diffInhours = $created_at->diffInHours($now);

                    if($diffInhours >= 72){
                        $tradein = Tradein::find($device->tradein_id);
                        $user = User::find($tradein->user_id);
                        $message = "we have attempted to transfer payment to you on " . $created_at->format('d.m.Y') .", 
                        but it hasn't worked. Not to worry, you simply sign into your account and
                        check your payment details are correct, you'll be able to amend them if not.";
                        //$klaviyo->paymentUnsuccesful($user, $tradein, $message);

                        BatchDeviceEmail::create([
                            'type' => 2,
                            'order' => 2,
                            'batch_device_id' => $device->id
                        ]);

                        $logfile = fopen("fpcronlog.txt", "a");
                        fwrite($logfile, "Sent second failed payment mail for tradein barcode: " . $tradein->barcode . " \n");
                        fclose($logfile);
                    }
                    break;

                case 2:
                    $created_at = $failed_mails->last()->created_at;
                    $diffInhours = $created_at->diffInHours($now);

                    if($diffInhours >= 72){
                        $tradein = Tradein::find($device->tradein_id);
                        $user = User::find($tradein->user_id);
                        $message = "we have tried to contact you on 2 occasions without any response and
                        therefore unable to pay you by bank transfer. To ensure we pay you we will raise a cheque
                        for £" . $tradein->bamboo_price . " and it will be posted to the registered address on your account'";
                        //$klaviyo->paymentUnsuccesful($user, $tradein, $message);

                        BatchDeviceEmail::create([
                            'type' => 2,
                            'order' => 3,
                            'batch_device_id' => $device->id
                        ]);

                        $logfile = fopen("fpcronlog.txt", "a");
                        fwrite($logfile, "Sent third failed payment mail for tradein barcode: " . $tradein->barcode . " \n");
                        fclose($logfile);
                    }
                    break;
                default:
                    break;
            }

        }
        echo "All good. Check log.";
        return 0;
    }
}
