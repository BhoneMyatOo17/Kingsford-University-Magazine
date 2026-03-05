<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Student;
use App\Notifications\SubmissionDeadlineReminder;
use Illuminate\Console\Command;

class NotifyDeadlineReminders extends Command
{
  protected $signature   = 'notify:deadline-reminders';
  protected $description = 'Notify students when a submission deadline is within 4 days';

  public function handle(): void
  {
    // Posts closing within 4 days (inclusive of today)
    $posts = Post::whereBetween('closure_date', [today(), today()->addDays(4)])
      ->with('faculty.students.user')
      ->get();

    foreach ($posts as $post) {
      $faculty = $post->faculty ?? null;
      if (!$faculty) continue;

      foreach ($faculty->students as $student) {
        if (!$student->user) continue;

        // Only notify students who haven't already submitted for this post
        $hasSubmitted = $student->contributions()
          ->where('post_id', $post->id)
          ->exists();

        if ($hasSubmitted) continue;

        // Avoid duplicate notifications: one per post per day
        $alreadyNotified = $student->user->notifications()
          ->where('type', SubmissionDeadlineReminder::class)
          ->whereDate('created_at', today())
          ->whereJsonContains('data->post_id', $post->id)
          ->exists();

        if (!$alreadyNotified) {
          $student->user->notify(new SubmissionDeadlineReminder($post));
        }
      }
    }

    $this->info('Deadline reminder notifications dispatched.');
  }
}
