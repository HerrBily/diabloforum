<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Gate;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth', ['except' => 'index']);
        
    }

    // public function index($categoryId, Thread $thread)
    // {

    //     return $thread->replies()->paginate(1);
        
    // }



    /**
     * @param integer $categoryId
     * @param $categoryId
     * @param Thread $thread
     * @param CreatePostForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($categoryId, Thread $thread)
    {

        if(Gate::denies('create', new Reply)) {
            return response(
            'Du kommentierst zu viel. Mach mal langsam. :', 429);
        }
        
        try {

            // $this->authorize('create', new Reply);
            
            $this->validate(request(), ['body' => 'required|spamfree']);

            $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ]);
        } catch (\Exception $e) {

            return response(
                'Leider konnte dein Kommentar nicht gespeichert werden.', 422);

        }

        
        return $reply->load('owner');
    }


    /**
     * 
     */
    public function update (Reply $reply)
    {
        $this->authorize('update', $reply);

        try {

            $this->validate(request(), ['body' => 'required|spamfree']);
    
            $reply->update(request(['body']));

        } catch (\Exception $e) {

            return response(
                'Leider konnte dein Kommentar nicht gespeichert werden.', 422);

        }
        

    }


    public function destroy (Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Du hast das Kommentar gelöscht.']);
        }

        return back();
    }

}
