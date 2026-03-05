<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SubmissionDeadlineReminder extends Notification
{
  use Queueable;

  public function __construct(public Post $post) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toArray(object $notifiable): array
  {
    $daysLeft = now()->startOfDay()->diffInDays($this->post->closure_date->startOfDay(), false);

    return [
      'event'    => 'deadline_reminder',
      'message'  => "Submission deadline for \"{$this->post->title}\" is in {$daysLeft} day(s).",
      'post_id'  => $this->post->id,
      'deadline' => $this->post->closure_date->toDateString(),
      'url'      => route('posts.show', $this->post),
    ];
  }
}
