<?php

namespace App\Mail;

use App\Models\Contribution;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContributionSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Contribution $contribution,
        public User $coordinator
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contribution Submitted: ' . $this->contribution->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contributions',
        );
    }
}
