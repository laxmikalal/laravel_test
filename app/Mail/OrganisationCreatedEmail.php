<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Organisation;

class OrganisationCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Organisation instance.
     *
     * @var Organisation
     */
    public $Organisation;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Organisation $organisation)
    {
        $this->organisation = $organisation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->from('organisation@org.com')
                    ->view('emails.organisation')
                    ->with([
                        'user' => $this->organisation->owner->name,
                        'organisation' => $this->organisation->name,
                    ]);

}
}
