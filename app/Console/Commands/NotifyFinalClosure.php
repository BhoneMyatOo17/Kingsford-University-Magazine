<?php

namespace App\Console\Commands;

use App\Models\AcademicYear;
use App\Models\User;
use App\Notifications\FinalClosurePassed;
use Illuminate\Console\Command;

class NotifyFinalClosure extends Command
{
  protected $signature   = 'notify:final-closure';
  protected $description = 'Notify marketing managers when the final closure date has just passed';

  public function handle(): void
  {
    // Academic years whose final_closure_date was yesterday (just passed)
    $academicYears = AcademicYear::whereDate('final_closure_date', today()->subDay())->get();

    if ($academicYears->isEmpty()) {
      $this->info('No final closures to notify.');
      return;
    }

    $managers = User::role('marketing_manager')->get();

    foreach ($academicYears as $academicYear) {
      foreach ($managers as $manager) {
        $alreadyNotified = $manager->notifications()
          ->where('type', FinalClosurePassed::class)
          ->whereJsonContains('data->academic_year_id', $academicYear->id)
          ->exists();

        if (!$alreadyNotified) {
          $manager->notify(new FinalClosurePassed($academicYear));
        }
      }
    }

    $this->info('Final closure notifications sent.');
  }
}
