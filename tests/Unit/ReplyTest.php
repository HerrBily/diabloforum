<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReplyTest extends TestCase
{

    use DatabaseMigrations;
    
    /** @test */
    function hat_einen_besitzer ()
    {
        $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }

     /** @test */
     function ein_kommentar_wurde_gerade_gepostet ()
     {
         $reply = create('App\Reply');
 
         $this->assertTrue($reply->wasJustPublished());

         $reply->created_at = Carbon::now()->subMonth();

         $this->assertFalse($reply->wasJustPublished());

     }
}
