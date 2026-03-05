<?php

namespace App\Notifications;

use App\Models\Contribution;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewSubmissionPending extends Notification
{
  use Queueable;

  public function __construct(public Contribution $contribution) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toArray(object $notifiable): array
  {
    return [
      'event'           => 'new_submission',
      'message'         => "New submission \"{$this->contribution->title}\" is waiting for your review.",
      'contribution_id' => $this->contribution->id,
      'title'           => $this->contribution->title,
      'url'             => route('contributions.show', $this->contribution),
    ];
  }
}
