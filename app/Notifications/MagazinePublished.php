<?php

namespace App\Notifications;

use App\Models\AcademicYear;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MagazinePublished extends Notification
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
      'event'            => 'magazine_published',
      'message'          => "The annual magazine for \"{$this->academicYear->name}\" has been published!",
      'academic_year_id' => $this->academicYear->id,
      'url'              => route('magazine.index'),
    ];
  }
}
