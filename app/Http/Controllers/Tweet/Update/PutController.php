<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\UpdateRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function __invoke(UpdateRequest $request): array
    {
        $tweet = Tweet::where('id', $request->id())->firstOrFail();
        $tweet->content = $request->content();
        $result = $tweet->save();
        // return redirect()->route('tweet.index');
        return ['result' => $result];
    }
}
