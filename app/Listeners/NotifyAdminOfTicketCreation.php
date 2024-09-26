<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminOfTicketCreation
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
    public function handle(TicketCreated $event): void
    {
        $admins = User::where('user_type', User::USER_TYPE_ADMIN)->get(); // Assuming you have a role attribute
        foreach ($admins as $admin) {
            $admin->notify(new TicketNotification("A new ticket has been created: {$event->ticket->subject}"));
        }
    }
}
