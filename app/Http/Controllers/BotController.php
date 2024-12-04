<?php

namespace App\Http\Controllers;

use App\Telegram\Commands\StartCommand;
use Illuminate\Http\Request;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use App\Telegram\Commands;

class BotController extends Controller
{
    protected $telegram;

    /**
     * @throws TelegramSDKException
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function show(Api $telegram)
    {

        $this->telegram = $telegram;

        $response = $telegram->sendMessage([
            'text' => ('Hello World')
        ]);

        Telegram::addCommand(StartCommand::class);

        return $response;


    }

    public function handleWebhook(Request $request)
    {
        $update = Telegram::getWebhookUpdates();

        // Check if the message is a /start command
        if ($update->getMessage()->getText() == '/start') {
            $chatId = $update->getMessage()->getChat()->getId();

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Hello! Welcome to the bot. Type /help for assistance.'
            ]);
        }
    }
}
