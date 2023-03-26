<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        $tweetId = (int)$request->route('id');
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        $result = $tweet->delete();
        return ['result' => $result];
    }
}
