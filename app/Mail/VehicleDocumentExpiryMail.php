<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VehicleDocumentExpiryMail extends Mailable
{
    use Queueable, SerializesModels;
    public $document;
    public $companyBilling;
    /**
     * Create a new message instance.
     */
    public function __construct($document, $companyBilling)
    {
        $this->document = $document;
        $this->companyBilling = $companyBilling;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $status = ($this->document->end_date < date('Y-m-d')) ? 'Expired' : 'Expiring Soon';

        return new Envelope(
            subject: "⚠️ Vehicle Document {$status}: {$this->document->documentName}"
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
       return new Content(
            view: 'emails.vehicle_expiry', // ✅ your actual Blade view file
            with: [
                'document' => $this->document,
                'companyBilling' => $this->companyBilling,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
