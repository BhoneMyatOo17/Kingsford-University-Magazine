<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewReport extends Notification
{
  use Queueable;

  public function __construct(public Report $report) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toArray(object $notifiable): array
  {
    $reporter = $this->report->reportedBy->name ?? 'A user';

    return [
      'event'     => 'new_report',
      'message'   => "{$reporter} has submitted a new report.",
      'report_id' => $this->report->id,
      'url'       => route('reports.index', $this->report),
    ];
  }
}
