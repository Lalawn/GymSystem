<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start the bot and welcome the user';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Welcome to the bot!',
        ]);
    }
}
