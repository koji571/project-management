<?php

namespace App\Http\Conversations;

use Exception;
use App\Http\Services\GPTEngine;
use Illuminate\Support\Facades\Log;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class DatabaseQueryConversation extends Conversation
{
    protected $question;

    public function askQuestion()
    {
        $this->ask('What question do you have about the database?', function(Answer $answer) {
            $this->question = $answer->getText();
            $this->processQuestion();
        });
    }

    protected function processQuestion()
    {
        $engine = new GPTEngine();
        try {
            $reply = $engine->ask($this->question);
            // Assuming $replyData is an array with 'type' and 'result'
            //$reply = $this->formatReply($replyData);
        } catch (Exception $e) {
            $reply = 'Sorry, the AI assistant was unable to answer your question. Please try to rephrase your question.';
        }
        $this->say($reply);
    }

    protected function formatReply($result)
    {
        // More conditions based on type of replyData
        return "Here's what I found: " . json_encode($result);
    }

    public function run()
    {
        $this->askQuestion();
    }
}

