<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminResolvedReport extends Notification
{
  use Queueable;

  public function __construct(public Report $report) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toArray(object $notifiable): array
  {
    return [
      'event'     => 'report_resolved',
      'message'   => 'Admin has resolved your report.',
      'report_id' => $this->report->id,
      'note'      => $this->report->resolution_note,
      'url'       => route('reports.my', $this->report),
    ];
  }
}
