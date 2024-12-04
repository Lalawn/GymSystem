<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Cache;
use App\Telegram\Commands\LinkCommand;

class PollTelegramCommand extends Command
{
    protected $signature = 'telegram:poll';
    protected $description = 'Polls Telegram for new messages and handles commands';

    protected $lastUpdateId = 0;

    public function handle()
    {
        $this->info('Starting Telegram Long Polling...');

        while (true) {
            // Fetch updates starting from the next unprocessed update
            $updates = Telegram::getUpdates(['offset' => $this->lastUpdateId + 1]);

            foreach ($updates as $update) {
                $telegramUserId = $update->getMessage()->getFrom()->getId();
                $text = $update->getMessage()->getText();

                // Check if user is in a "linking" process
                if (Cache::get("link_step_{$telegramUserId}") === 'awaiting_email') {
                    $linkCommand = new LinkCommand();
                    $linkCommand->processEmail($telegramUserId, $text);
                } else {
                    // Process the update as a regular command
                    Telegram::processCommand($update);
                }

                // Update the last processed update ID
                $this->lastUpdateId = $update->updateId;
            }

            sleep(2); // Prevent hitting API limits
        }
    }
}
