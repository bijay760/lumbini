<?php
// app/Mail/PropertyRegistered.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Property;

class PropertyRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Your Property Listing Has Been Received',
        );
    }

    public function content()
    {
        return new Content(
            view: 'email.registered',
        );
    }

    public function attachments()
    {
        return [];
    }
}
