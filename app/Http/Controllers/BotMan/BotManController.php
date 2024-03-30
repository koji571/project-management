<?php

namespace App\Http\Controllers\BotMan;

use BotMan\BotMan\BotMan;
use App\Http\Controllers\Controller;
use App\Http\Conversations\DatabaseQueryConversation;

class BotManController extends Controller {

    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{command}', function (BotMan $bot, $command) {
            // Trigger the conversation
            $bot->startConversation(new DatabaseQueryConversation($command));
        });

        $botman->listen();
    }
}
