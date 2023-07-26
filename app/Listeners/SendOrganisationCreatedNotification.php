<?php

namespace App\Listeners;

use App\Events\OrganisationCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrganisationCreatedEmail;



class SendOrganisationCreatedNotification
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
     * @param  App\Events\OrganisationCreated  $event
     * @return void
     */
    public function handle(OrganisationCreated $event)
    {
        Mail::to($event->organisation->owner)->send(new OrganisationCreatedEmail($event->organisation));       
    }
}
