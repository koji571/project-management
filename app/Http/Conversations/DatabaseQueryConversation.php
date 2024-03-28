<?php

namespace App\Http\Conversations;

use Exception;
use App\Http\Services\Botman\BotmanGPTEngine;
use Illuminate\Support\Facades\Log;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class DatabaseQueryConversation extends Conversation
{
    protected $question;

    public function run()
    {
        $this->askQuestion();
    }

    public function askQuestion()
    {
        $this->ask('What question do you have about the database?', function(Answer $answer) {
            $this->question = $answer->getText();
            $this->processQuestion();
        });
    }

    protected function processQuestion()
    {
        $engine = new BotmanGPTEngine();
        try {
            $reply = $engine->ask($this->question);
            // Assuming $replyData is an array with 'type' and 'result'
            //$reply = $this->formatReply($replyData);
        } catch (Exception $e) {
            $reply = 'Sorry, the AI assistant was unable to answer your question. Please try to rephrase your question.';
        }
        $this->say($reply);
    }

}

