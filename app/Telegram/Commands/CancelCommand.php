<?php
namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Cache;

class CancelCommand extends Command
{
    protected string $name = "cancel";
    protected string $description = "Cancel your registration for an event by ID.";

    public function handle()
    {
        $telegramUserId = $this->getUpdate()->getMessage()->getFrom()->getId();
        $text = $this->getUpdate()->getMessage()->getText();
        $parts = explode(' ', $text);

        if (count($parts) < 2 || !is_numeric($parts[1])) {
            $this->replyWithMessage(['text' => 'Usage: /cancel {event_id}. Please provide a valid event ID.']);
            return;
        }

        $eventId = $parts[1];
        $linkedUser = Cache::get("{$telegramUserId}");

        if (!$linkedUser) {
            $this->replyWithMessage(['text' => 'You are not linked to any user account. Use /link {user_id} to link.']);
            return;
        }

        $user = \App\Models\User::find($linkedUser['id']);

        if (!$user->registeredEvents()->where('event_id', $eventId)->exists()) {
            $this->replyWithMessage(['text' => 'You are not registered for this event.']);
            return;
        }

        $user->registeredEvents()->detach($eventId);

        $this->replyWithMessage(['text' => 'Your registration for the event has been canceled.']);
    }
}
