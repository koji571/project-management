<?php

namespace App\Http\Controllers\BotMan;

use App\Http\Controllers\Controller;
use BotMan\BotMan\messages\Incoming\Answer;

class BotManController extends Controller {

public function handle() {
    $botman = app('botman');

    $botman->hears('{message}', function($botman, $message) {

        if ($message == 'hi') {
            $this->askName($botman);
        } else {
            $botman->replay("Hi, testing");
        }

    });
    $botman->listen();
    }

    public function askName($botman) {
        $botman->ask("Hello!, Whats, your name?", function(Answer $answer) {
            $name = $answer->getText();

            $this->say('nice to meet you ', $name);
        });
    }
}
