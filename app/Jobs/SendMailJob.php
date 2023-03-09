<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\WelcomeMail;
use Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $firstname;
    public $password;
    public $createdBy;
    public $toEmail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($firstname, $password, $createdBy, $toEmail)
    {
        $this->firstname = $firstname;
        $this->password = $password;
        $this->createdBy = $createdBy;
        $this->toEmail = $toEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->toEmail)->send(new WelcomeMail($this->firstname, $this->password, $this->createdBy));
    }
}
