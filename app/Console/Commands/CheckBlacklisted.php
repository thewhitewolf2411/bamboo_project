<?php

namespace App\Console\Commands;

use App\Eloquent\Tradein;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckBlacklisted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:blacklisted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for blacklisted devices status.';

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
     * Send notification to user if after 12 days user did not contacted bamboo team.
     *
     * @return int
     */
    public function handle()
    {
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
        return 0;
    }
}
