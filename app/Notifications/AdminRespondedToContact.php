<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminRespondedToContact extends Notification
{
  use Queueable;

  public function __construct(public Contact $contact) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toArray(object $notifiable): array
  {
    return [
      'event'      => 'admin_contact_response',
      'message'    => "Admin has responded to your contact request: \"{$this->contact->subject}\"",
      'contact_id' => $this->contact->id,
      'url'        => route('contact.my', $this->contact),
    ];
  }
}
