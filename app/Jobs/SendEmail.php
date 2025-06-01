<?php

namespace App\Jobs;

use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
class SendEmail
{
    use Dispatchable;

    public $data;

    public function __construct( $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        Mail::to('vijaybadhur760@gmail.com')->send($this->data);
    }
}
