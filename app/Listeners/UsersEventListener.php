<?php

namespace App\Listeners;

use Illuminate\Auth\Event\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UsersEventListener
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $e)
    {
        //
        $e->user->last_login = \Carbon\Carbon::now();

        return $e->user->save();
    }
}
