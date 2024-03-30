<?php

namespace App\Http\Conversations;

use Exception;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Http\Services\Botman\BotmanGPTEngine;
use BotMan\BotMan\Messages\Conversations\Conversation;

class DatabaseQueryConversation extends Conversation
{
    protected $initialQuestion;

    // Updating constructor to accept the initial question
    public function __construct($initialQuestion)
    {
        $this->initialQuestion = $initialQuestion;
    }

    public function run()
    {
        // Use the initial question to ask the BotmanGPTEngine
        $this->askBotmanGPTEngine($this->initialQuestion);
    }

    protected function askBotmanGPTEngine($question)
    {
        // Instantiate the engine
        $engine = new BotmanGPTEngine();

        try {
            // Attempt to get an answer for the question
            $reply = $engine->ask($question);
            $this->say($reply);
        } catch (Exception $e) {
            info($e);
            // Handle exceptions, such as inability to get a response
            $this->say('Sorry, there was an error processing your question. Please try again.');
        }
    }
}


