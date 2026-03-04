<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Jenssegers\Agent\Agent;

class UpdateLoginInfo
{
    public function handle(Login $event): void
    {
        $user = $event->user;
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);

        $user->previous_login_at  = $user->last_login_at;
        $user->last_login_at      = now();
        $user->last_login_browser = $browser . ($version ? ' ' . $version : '');
        $user->saveQuietly();
    }
}
