<?php

namespace App\Http\Services;

use OpenAI;
use Illuminate\Support\Str;

/**
 * Code base taken from abandoned GitHub repo:
 * https://github.com/beyondcode/laravel-ask-database/tree/main
 */
class GPTEngine
{
    protected string $connection;
    private $client;

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.key'));
    }

    public function ask(string $prompt): string
    {
        $answer = $this->queryOpenAi($prompt, "\n", 0.7);

        return Str::of($answer)
             ->trim()
             ->trim('"');
    }
    protected function queryOpenAi(string $prompt, string $stop, float $temperature = 0.0)
    {
        $completions = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $prompt,
                ]
            ],
            'temperature' => $temperature,
            'max_tokens' => 100,
            'stop' => $stop,
        ]);

        return $completions->choices[0]->message->content;
    }
}
