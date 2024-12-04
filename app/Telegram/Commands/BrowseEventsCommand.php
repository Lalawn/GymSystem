<?php
namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use App\Models\Event;

class BrowseEventsCommand extends Command
{
    protected string $name = "browse_events";
    protected string $description = "View all available events.";

    public function handle()
    {
        $events = Event::where('event_date', '>=', now())->get();

        if ($events->isEmpty()) {
            $this->replyWithMessage(['text' => 'No available events at the moment.']);
            return;
        }

        $message = "Available Events:\n";
        foreach ($events as $event) {
            $message .= "- ID: {$event->id}, {$event->name} on {$event->event_date}\n";
        }

        $this->replyWithMessage(['text' => $message]);
    }
}
