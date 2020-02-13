<?php

namespace App\Http\Controllers;

use App\Thread;

class ThreadSubscriptionsController extends Controller
{
    
    public function store ($categoryId, Thread $thread)
    {
        $thread->subscribe();


    }


    public function destroy ($categoryId, Thread $thread)
    {
        $thread->unsubscribe();


    }

}
