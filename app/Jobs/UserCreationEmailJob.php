<?php

namespace App\Jobs;

use App\Mail\UserCreationMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserCreationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 7200; // 2 hours
    protected $to, $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $name)
    {
        $this->to = $email;
        $this->name = $name;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->to)->send(new UserCreationMailable($this->name));
    }
}
