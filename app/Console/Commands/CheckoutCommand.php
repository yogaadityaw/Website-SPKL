<?php

namespace App\Console\Commands;

use App\Models\UserSpkl;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckoutCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:checkout-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically check out users after 3 hours of overtime';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threeHoursAgo = Carbon::now()->subHours(3);

        $attendances = UserSpkl::whereNull('check_out')
            ->where('check_in', '<=', $threeHoursAgo)
            ->get();
        foreach ($attendances as $attendance) {
            $attendance->update([
                'check_out' => Carbon::now()
            ]);

            $this->info("Auto checked out user ID: {$attendance->user_id}");
        }
    }
}
