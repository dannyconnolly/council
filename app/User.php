<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    protected $casts = [
        'confirmed' => 'boolean'
    ];

    /**
     * Get the route key name for Laravel
     * 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Fetch all threads that were created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    /**
     * Get all activity for the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function confirm()
    {
        $this->confirmed = true;

        $this->confirmation_token = null;

        $this->save();
    }
    
    public function isAdmin() 
    {
        return in_array($this->name, ['admin']);
    }

    /**
     * @param Thread $thread
     * @return string
     */
    public function visitedThreadCacheKey($thread)
    {
        return sprintf('users.%s.visits.%s', $this->id, $thread->id);
    }

    public function read($thread)
    {
        cache()->forever($this->visitedThreadCacheKey($thread), \Carbon\Carbon::now());
    }

    public function getAvatarPathAttribute($avatar)
    {
        $avatar_path = $avatar ? 'storage/' . $avatar : false;
        return asset($avatar_path ?: 'images/avatars/default.png');
    }
}
