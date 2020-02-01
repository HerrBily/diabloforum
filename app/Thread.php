<?php

namespace App;

use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'category'];

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

        return $this->replies()->create($reply);
        
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


}
