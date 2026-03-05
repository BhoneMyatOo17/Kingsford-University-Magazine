<?php

namespace App\Notifications;

use App\Models\Contribution;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContributionStatusUpdated extends Notification
{
  use Queueable;

  public function __construct(
    public Contribution $contribution,
    public string $event
  ) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toArray(object $notifiable): array
  {
    $messages = [
      'commented' => 'A coordinator commented on your contribution.',
      'approved'  => 'Your contribution has been approved for publication.',
      'rejected'  => 'Your contribution has been rejected.',
    ];

    return [
      'event'           => $this->event,
      'message'         => $messages[$this->event] ?? 'Your contribution was updated.',
      'contribution_id' => $this->contribution->id,
      'title'           => $this->contribution->title,
      'url'             => route('contributions.show', $this->contribution),
    ];
  }
}
