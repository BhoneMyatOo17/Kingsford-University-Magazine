<?php

namespace App\Console\Commands;

use App\Models\Contribution;
use App\Models\Staff;
use App\Notifications\OverdueSubmissionAlert;
use Illuminate\Console\Command;

class NotifyOverdueSubmissions extends Command
{
  protected $signature   = 'notify:overdue-submissions';
  protected $description = 'Notify marketing coordinators of contributions with no comment after 14 days';

  public function handle(): void
  {
    // Contributions older than 14 days with no comments, not already resolved
    $overdue = Contribution::whereDoesntHave('comments')
      ->where('created_at', '<=', now()->subDays(14))
      ->whereNotIn('status', ['approved', 'rejected'])
      ->with('post.faculty.staff.user')
      ->get();

    foreach ($overdue as $contribution) {
      $faculty = $contribution->post->faculty ?? null;
      if (!$faculty) continue;

      $coordinator = $faculty->staff
        ->filter(fn($s) => $s->user && $s->user->hasRole('marketing_coordinator'))
        ->first();

      if (!$coordinator?->user) continue;

      // Avoid duplicate notifications: skip if already notified today for this contribution
      $alreadyNotified = $coordinator->user->notifications()
        ->where('type', OverdueSubmissionAlert::class)
        ->whereDate('created_at', today())
        ->whereJsonContains('data->contribution_id', $contribution->id)
        ->exists();

      if (!$alreadyNotified) {
        $coordinator->user->notify(new OverdueSubmissionAlert($contribution));
      }
    }

    $this->info("Overdue submission notifications sent: {$overdue->count()} checked.");
  }
}
