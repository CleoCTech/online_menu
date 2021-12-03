<?php

namespace App\Listeners;

use App\Models\PasswordReset;
use App\Models\Restraunt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResPasswordResetListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        PasswordReset::where('email', $event->user->email)->delete();
    }
}