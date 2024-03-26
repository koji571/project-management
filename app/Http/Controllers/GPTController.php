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
}
