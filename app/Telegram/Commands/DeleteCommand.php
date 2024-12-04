<?php
namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\Event;

class DeleteCommand extends Command
{
    protected string $name = "delete";
    protected string $description = "Delete one of your events by ID.";

    public function handle()
    {
        $telegramUserId = $this->getUpdate()->getMessage()->getFrom()->getId();
        $text = $this->getUpdate()->getMessage()->getText();
        $parts = explode(' ', $text);

        if (count($parts) < 2 || !is_numeric($parts[1])) {
            $this->replyWithMessage(['text' => 'Usage: /delete {event_id}. Please provide a valid event ID.']);
            return;
        }

        $eventId = $parts[1];
        $linkedUser = Cache::get("{$telegramUserId}");

        if (!$linkedUser) {
            $this->replyWithMessage(['text' => 'You are not linked to any user account. Use /link {user_id} to link.']);
            return;
        }

        $user = \App\Models\User::find($linkedUser['id']);
        if (!$user->isTrainer()) {
            $this->replyWithMessage(['text' => 'This command is only available to trainers.']);
            return;
        }

        $event = Event::where('id', $eventId)
            ->where('trainer_id', $user->id)
            ->first();

        if (!$event) {
            $this->replyWithMessage(['text' => 'Event not found or you do not have permission to delete this event.']);
            return;
        }

        $event->delete();

        $this->replyWithMessage(['text' => "Event ID {$eventId} has been successfully deleted."]);
    }
}
