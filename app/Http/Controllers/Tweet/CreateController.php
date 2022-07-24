<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function __invoke(CreateRequest $request): array
    {
        $tweet = new Tweet();
        $tweet->content = $request->content();
        $result = $tweet->save();
        // return redirect()->route('tweets.index');
        return ['result' => $result];
    }
}
