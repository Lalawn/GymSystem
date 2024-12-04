<?php

// app/Providers/TelegramServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Laravel\Facades\Telegram;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind any services or classes if necessary
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Telegram::addCommands([
            \App\Telegram\Commands\StartCommand::class,
            \App\Telegram\Commands\LinkCommand::class,
            \App\Telegram\Commands\BrowseEventsCommand::class,
            \App\Telegram\Commands\MyEventsCommand::class,
            \App\Telegram\Commands\RegisterCommand::class,
            \App\Telegram\Commands\CancelCommand::class,
            \App\Telegram\Commands\TrainerMyEventsCommand::class,
            \App\Telegram\Commands\DeleteCommand::class,
        ]);
    }
}
