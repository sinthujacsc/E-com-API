<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Fascades\Session;
use Spartie\Activitylog\Models\Activity;

class LoginSuccessful
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
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        $event->subject = 'login';
        $event->description ='Login Successful';

        Session::flash('login-success', 'Hello' . $event->user->name . ', Welcome Back!');
        activity($event->subject)
        ->by($event->user)
        ->log($event->description);
        //
    }
}
