<?php

namespace App;

use App\Notifications\ThreadWasUpdated;
use App\Events\ThreadHasNewReply;
use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'category'];

    protected $appends = ['isSubscribedTo'];
    

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {

            $builder->withCount('replies');
        });

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }


    public function path ()
    {
        return "/beitraege/{$this->category->slug}/{$this->id}";
    }


    
    
    public function creator ()
    {
        
        return $this->belongsTo(User::class, 'user_id');
        
    }
    
    public function category()
    {
        
        return $this->belongsTo(Category::class);
        
    }

    /**
     * @param $reply
     */
    public function replies ()
    {

        return $this->hasMany(Reply::class);

    }

    /**
     * @param array $reply
     * @return Reply
     * 
     */
    public function addReply ($reply)
    {

        $reply = $this->replies()->create($reply);

        $this->notifySubscribers($reply);

        return $reply;
        
    }


    public function notifySubscribers ($reply)
    {
        $this->subscriptions
            ->where('user_id', '!=' , $reply->user_id)
            ->each->notify($reply);

    }


    public function scopeFilter ($query, $filters)
    {

        return $filters->apply($query);
        
    }


    public function hasUpdatesFor ($user)
    {
        
        $key = $user->visitedThreadCacheKey($this);
        

        return $this->updated_at > cache($key);


    }


    /**
     * @param int|null $userId
     * @return $this
     */

    public function subscribe ($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);

        return $this;

    }

    public function subscriptions ()
    {
        
       return $this->hasMany(ThreadSubscription::class);
    }


    public function unsubscribe ($userId = null)
    {
        
       $this->subscriptions()
        ->where('user_id', $userId ?: auth()->id())
        ->delete();
    }


    public function getIsSubscribedToAttribute ()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
       
    }

    


}
