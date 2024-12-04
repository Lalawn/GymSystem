<?php
namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\Event;

class RegisterCommand extends Command
{
    protected string $name = "register";
    protected string $description = "Register for an event by ID.";

    public function handle()
    {
        $telegramUserId = $this->getUpdate()->getMessage()->getFrom()->getId();
        $text = $this->getUpdate()->getMessage()->getText();
        $parts = explode(' ', $text);

        if (count($parts) < 2 || !is_numeric($parts[1])) {
            $this->replyWithMessage(['text' => 'Usage: /register {event_id}. Please provide a valid event ID.']);
            return;
        }

        $eventId = $parts[1];
        $linkedUser = Cache::get("{$telegramUserId}");

        if (!$linkedUser) {
            $this->replyWithMessage(['text' => 'You are not linked to any user account. Use /link {user_id} to link.']);
            return;
        }

        $user = \App\Models\User::find($linkedUser['id']);
        $event = Event::find($eventId);

        if (!$event) {
            $this->replyWithMessage(['text' => "No event found with ID {$eventId}."]);
            return;
        }

        if ($user->registeredEvents()->where('event_id', $eventId)->exists()) {
            $this->replyWithMessage(['text' => 'You are already registered for this event.']);
            return;
        }

        $user->registeredEvents()->attach($eventId);

        $this->replyWithMessage(['text' => "You have successfully registered for {$event->name} on {$event->event_date}."]);
    }
}
