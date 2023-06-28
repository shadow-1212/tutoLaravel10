<?php

namespace App\Listeners;

use App\Events\ContactRequestEvent;
use App\Mail\PostContactMail;
use Illuminate\Mail\Mailer;
class ContactListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private Mailer $mailer)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContactRequestEvent $event): void
    {
        $this->mailer->send(new PostContactMail($event->post, $event->data));

    }
}
