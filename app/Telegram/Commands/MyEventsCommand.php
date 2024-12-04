<?php
namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Cache;

class MyEventsCommand extends Command
{
    protected string $name = "my_events";
    protected string $description = "View your registered events.";

    public function handle()
    {
        $telegramUserId = $this->getUpdate()->getMessage()->getFrom()->getId();

        $linkedUser = Cache::get("{$telegramUserId}");

        if (!$linkedUser) {
            $this->replyWithMessage(['text' => 'You are not linked to any user account. Use /link {user_id} to link.']);
            return;
        }

        $user = \App\Models\User::find($linkedUser['id']);
        $registeredEvents = $user->registeredEvents()->with('trainer')->get();

        if ($registeredEvents->isEmpty()) {
            $this->replyWithMessage(['text' => 'You have no registered events.']);
            return;
        }

        $message = "Your Registered Events:\n";
        foreach ($registeredEvents as $event) {
            $trainer = $event->trainer->name ?? 'N/A';
            $message .= "- ID: {$event->id}, {$event->name} on {$event->event_date} with Trainer: {$trainer}\n";
        }

        $this->replyWithMessage(['text' => $message]);
    }
}
