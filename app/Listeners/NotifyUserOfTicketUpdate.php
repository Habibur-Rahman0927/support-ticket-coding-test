<?php

namespace App\Listeners;

use App\Events\TicketUpdated;
use App\Notifications\TicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUserOfTicketUpdate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketUpdated $event): void
    {
        $event->ticket->user->notify(new TicketNotification("Your ticket has been updated: {$event->ticket->subject}"));
    }
}
