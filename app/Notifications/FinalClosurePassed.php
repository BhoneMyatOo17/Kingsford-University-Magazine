<?php

namespace App\Notifications;

use App\Models\AcademicYear;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FinalClosurePassed extends Notification
{
  use Queueable;

  public function __construct(public AcademicYear $academicYear) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toArray(object $notifiable): array
  {
    return [
      'event'            => 'final_closure_passed',
      'message'          => "The final closure date for \"{$this->academicYear->name}\" has passed. Approved contributions are pending download and publishing.",
      'academic_year_id' => $this->academicYear->id,
      'url'              => route('contributions.index'),
    ];
  }
}
