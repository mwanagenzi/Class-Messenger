<?php

namespace App\Listeners;

use App\Events\AnnouncementCreated;
use App\Models\Announcement;
use App\Models\User;
use App\Notifications\NewAnnouncement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAnnouncementNotification implements ShouldQueue
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
    public function handle(AnnouncementCreated $event): void
    {
        //here, all the action necessary to respond to the event are executed
        foreach (User::whereNot('id', $event->announcement->user_id)->cursor() as $user) {
            $user->notify(new NewAnnouncement($event->announcement));
        }
    }
}
