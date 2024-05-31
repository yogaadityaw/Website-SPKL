<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendEmail;

class sendSpkl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $spkl;

    public function __construct($spkl)
    {
        $this->spkl = $spkl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->spkl->bengkel->departemen->user->email)->send(new sendEmail($this->spkl));
    }
}
