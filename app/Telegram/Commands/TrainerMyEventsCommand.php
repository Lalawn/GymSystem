<?php
namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\Event;

class TrainerMyEventsCommand extends Command
{
    protected string $name = "trainer_my_events";
    protected string $description = "View all your upcoming events, including those without participants.";

    public function handle()
    {
        $telegramUserId = $this->getUpdate()->getMessage()->getFrom()->getId();

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

        $events = Event::where('trainer_id', $user->id)
            ->where('event_date', '>=', now())
            ->with('registeredUsers')
            ->get();

        if ($events->isEmpty()) {
            $this->replyWithMessage(['text' => 'You have no upcoming events.']);
            return;
        }

        $message = "Your Upcoming Events:\n";
        foreach ($events as $event) {
            $participantCount = $event->registeredUsers->count();
            $message .= "- ID: {$event->id}, {$event->name} on {$event->event_date} ({$participantCount} participant(s))\n";
        }

        $this->replyWithMessage(['text' => $message]);
    }
}
