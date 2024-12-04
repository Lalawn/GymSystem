<?php
namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class LinkCommand extends Command
{
    protected string $name = "link";
    protected string $description = "Link your Telegram account to a user account for this session.";

    public function handle()
    {
        $telegramUserId = $this->getUpdate()->getMessage()->getFrom()->getId();
        $text = $this->getUpdate()->getMessage()->getText();

        $parts = explode(' ', $text);
        if (count($parts) < 2 || !is_numeric($parts[1])) {
            $this->replyWithMessage(['text' => 'Usage: /link {userid}. Please provide a valid user ID.']);
            return;
        }

        $userId = $parts[1];

        $user = User::find($userId);
        if (!$user) {
            $this->replyWithMessage(['text' => "No user found with ID {$userId}. Please try again."]);
            return;
        }

        Cache::put("{$telegramUserId}", ['id' => $user->id], now()->addHours(1));

        $this->replyWithMessage([
            'text' => "Successfully linked! Your Telegram account is now linked to user ID {$userId} ({$user->email}) for this session.",
        ]);
    }
}
