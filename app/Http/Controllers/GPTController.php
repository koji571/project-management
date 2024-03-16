<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\GPTEngine; // Make sure this matches the namespace of your GPTEngine service class

class GPTController extends Controller
{
    protected $gptEngine;

    public function __construct(GPTEngine $gptEngine)
    {
        $this->gptEngine = $gptEngine;
    }

    public function testGPT(Request $request)
    {
        dd("in");
        $question = $request->input('question', 'What is Laravel?');

        try {
            $answer = $this->gptEngine->ask($question);

            // If you have a view, you can return it here
            return response()->json([
                'question' => $question,
                'answer' => $answer,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
