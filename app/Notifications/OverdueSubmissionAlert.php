<?php

namespace App\Notifications;

use App\Models\Contribution;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OverdueSubmissionAlert extends Notification
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
      'event'           => 'overdue_submission',
      'message'         => "\"{$this->contribution->title}\" has been awaiting review for over 14 days.",
      'contribution_id' => $this->contribution->id,
      'title'           => $this->contribution->title,
      'url'             => route('contributions.show', $this->contribution),
    ];
  }
}
