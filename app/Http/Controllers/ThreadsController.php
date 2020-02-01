<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;

use App\Category;
use App\Thread;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    /**
     *ThreadsController constructor
     */
    public function __construct ()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * 
     * @param Category $category
     * @param ThreadFilters $filters
     * @return \Illuminate\Http\Response
     * 
     */

    public function index(Category $category, ThreadFilters $filters)
    {
    
        $threads = $this->getThreads($category, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('beitraege.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('beitraege.create');
    }
 
    /**
     * Store a newly created resource in storage.
     * 
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
            'category_id' => 'required|exists:categories,id'
        ]);


        $thread = Thread::create([
            'user_id' => auth()->id(),
            'category_id' => request('category_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect($thread->path())
            ->with('flash', 'Dein Beitrag wurde gepostet!');
    }

    /**
     * Display the specified resource.
     *
     * @param $category
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($category, Thread $thread)
    {
        // auth()->user()->read($thread);
        if (auth()->check()) {

            $key = sprintf("user.%s.visits.%s", auth()->id(), $thread->id);
    
            cache()->forever($key, Carbon::now());
        }

        return view('beitraege.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(20)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($category, Thread $thread)
    {
        $this->authorize('update', $thread);
        
        $thread->delete();
        
        if (request()->wantsJson()) {

            return response([], 204);
        }

        return redirect('/beitraege');

    }


    /**
     * @param Category $category
     * @return mixed
     */
    protected function getThreads(Category $category, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($category->exists) {
            $threads->where('category_id', $category->id);
        }

        return $threads->paginate(20);
    }
}
