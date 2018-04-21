<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Notifications\ThreadWasUpdated;

class ThreadSubscription extends Model
{
    /**
     * Don't auto-apply mass assignment protection
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * A subscription belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * 
     */
    public function notify($reply)
    {
        $this->user->notify(new ThreadWasUpdated($this->thread, $reply));
    }
}
