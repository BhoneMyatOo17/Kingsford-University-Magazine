<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Faculty;
use App\Mail\GuestRegisteredMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GuestAccountCreated extends Notification
{
  use Queueable;

  public function __construct(
    public User $guest,
    public Faculty $faculty
  ) {}

  public function via(object $notifiable): array
  {
    return ['mail', 'database'];
  }

  public function toMail(object $notifiable): GuestRegisteredMail
  {
    return new GuestRegisteredMail($this->guest, $this->faculty, $notifiable);
  }

  public function toArray(object $notifiable): array
  {
    return [
      'event'       => 'guest_account_created',
      'message'     => "A new guest has registered under {$this->faculty->name}. Guest email: {$this->guest->email}",
      'guest_email' => $this->guest->email,
      'guest_name'  => $this->guest->name,
      'faculty'     => $this->faculty->name,
      'faculty_id'  => $this->faculty->id,
      'url'         => route('guests.index'),
    ];
  }
}
