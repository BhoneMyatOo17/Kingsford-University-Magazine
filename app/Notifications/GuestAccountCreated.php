<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

// Placeholder — wire up in Sprint 3 when guest account creation is implemented.
// Dispatch this from wherever guest users are created:
//   $coordinator->user->notify(new GuestAccountCreated($guestEmail, $faculty));
class GuestAccountCreated extends Notification
{
  use Queueable;

  public function __construct(
    public string $guestEmail,
    public string $facultyName
  ) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toArray(object $notifiable): array
  {
    return [
      'event'       => 'guest_account_created',
      'message'     => "A new guest user has been registered in your faculty. Guest's email: {$this->guestEmail}",
      'guest_email' => $this->guestEmail,
      'faculty'     => $this->facultyName,
      'url'         => '#', // update to guest management route in Sprint 3
    ];
  }
}
