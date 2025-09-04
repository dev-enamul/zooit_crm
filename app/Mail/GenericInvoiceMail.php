<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class GenericInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $custom_subject;
    public $intro_message;
    public $invoices;
    public $attachmentPath;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $intro_message, Collection $invoices, $attachmentPath = null)
    {
        $this->custom_subject = $subject;
        $this->intro_message = $intro_message;
        $this->invoices = $invoices;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->custom_subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.generic_invoice',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        // যদি user-uploaded attachment থাকে
        if ($this->attachmentPath) {
            $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath(
                storage_path('app/public/' . $this->attachmentPath)
            );
        }

        // Inline logo embed
        $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath(
            public_path('assets/images/logo-dark.png')
        )->as('logo-dark.png')->withMime('image/png')->inline();

        return $attachments;
    }

}
