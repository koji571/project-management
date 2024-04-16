<?php

namespace App\Http\Services\RiskFinder;

use OpenAI;
use Illuminate\Support\Str;

class RiskFinderGPTService
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
            'max_tokens' => 2000
        ]);
        info($completions->toArray());
        return $completions->choices[0]->message->content;
    }
}
