<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewContactRequest extends Notification
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
      'event'      => 'new_contact',
      'message'    => "{$this->contact->name} sent a contact request: \"{$this->contact->subject}\"",
      'contact_id' => $this->contact->id,
      'url'        => route('contact.index', $this->contact),
    ];
  }
}
