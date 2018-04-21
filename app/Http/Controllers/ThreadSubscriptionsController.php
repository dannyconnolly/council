<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadSubscriptionsController extends Controller
{
    /**
     * Store a threads subscription
     * 
     * @param integer $channelId
     * @param Thread $thread
     * @return
     */
    public function store($channelId, Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Delete a threads subscription
     * 
     * @param integer $channelId
     * @param Thread $thread
     * @return
     */
    public function destroy($channelId, Thread $thread)
    {
        $thread->unsubscribe();
    }
}
