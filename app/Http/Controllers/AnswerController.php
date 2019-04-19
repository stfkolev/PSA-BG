<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Answer;
use App\Discussion;
use Auth;

class AnswerController extends Controller
{
    /**
     * Create a new AnswerController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Persist a new answer.
     *
     * @param  Discussion $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\App\Category $category, \App\Discussion $discussion)
    {
        if (Gate::denies('create', new Answer)) {
            return response(
                'You are posting too frequently. Please take a break. :)', 429
            );
        }

        $this->validate(request(), ['body' => 'required']);

        $discussion->addAnswer([
            'body' => request('body'),
            'user_id' => Auth::user()->id
        ]);

        return back();
    }
}
