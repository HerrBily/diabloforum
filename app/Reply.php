<?php

namespace App;

use Carbon\Carbon;
use App\Favorite;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    use Favoritable, RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    protected $appends = ['favoritesCount', 'isFavorited'];

    public function owner ()
    {

        return $this->belongsTo(User::class, 'user_id');
        
    }

    public function thread ()
    {

        return $this->belongsTo(Thread::class);
        
    }

    public function wasJustPublished ()
    {

        return $this->created_at->gt(Carbon::now()->subMinute());
        
    }

    

    public function path ()
    {

        return $this->thread->path() . "#reply-{$this->id}";
        
    }

}

