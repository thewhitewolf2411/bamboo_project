<?php

namespace App\Console\Commands;

use App\Eloquent\Tradein;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to users.';

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
     * Handle notifications.
     *
     * @return int
     */
    public function handle()
    {
        // check blacklisted devices
        $this->checkBlacklistedDevices();

        // check devices awaiting for despatch
        $this->checkDevicesWaitingForDespatch();

        return 0;
    }

    /**
     * Send notification to user if after 12 days user did not contacted bamboo team.
     *
     */
    public function checkBlacklistedDevices(){
        $blacklisted = ['8a', '8b', '8c', '8d', '8e', '8f'];
        $tradeins = Tradein::whereIn('job_state', $blacklisted)->get();
        $notificationService = new NotificationService();
        $now = Carbon::now();
        foreach($tradeins as $tradein){
            $blacklisted_at = Carbon::parse($tradein->quarantine_date);
            $diff = $now->diffInDays($blacklisted_at);
            if($diff >= 12){
                $notificationService->sendBlacklisted($tradein);
            }
        }
    }

    public function checkDevicesWaitingForDespatch(){
        $tradeins = Tradein::where('job_state', '21')->get();
        $now = Carbon::now();
        foreach($tradeins as $tradein){
            
        }
        dd($tradeins);
    }
}
