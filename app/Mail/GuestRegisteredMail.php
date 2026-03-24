<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Faculty;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class GuestRegisteredMail extends Mailable
{
  use Queueable, SerializesModels;

  public function __construct(
    public User $guest,
    public Faculty $faculty,
    public User $coordinator
  ) {}

  public function envelope(): Envelope
  {
    return new Envelope(
      to: [new Address($this->coordinator->email, $this->coordinator->name)],
      subject: 'New Guest Account Registered – ' . $this->faculty->name,
    );
  }

  public function content(): Content
  {
    return new Content(
      view: 'emails.guest-registered',
    );
  }

  public function attachments(): array
  {
    return [];
  }
}
