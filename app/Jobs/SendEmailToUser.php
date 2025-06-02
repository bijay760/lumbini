<?php

namespace App\Jobs;

use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
class SendEmailToUser
{
    use Dispatchable;

    public $data;
    public $to;

    public function __construct( $to,$data)
    {
        $this->data = $data;
        $this->to = $to;
    }

    public function handle(): void
    {
        Mail::to($this->to)->send($this->data);
    }
}
