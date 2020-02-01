<?php

namespace Tests\Unit;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
   use DatabaseMigrations;

   protected $thread;

   public function setUp()
   {
       parent::setUp();
       $this->thread = factory('App\Thread')->create();
   }

   /** @test */
   public function ein_beitrag_erstellt_einen_string_pfad ()
   {
       $thread = create('App\Thread');

       $this->assertEquals("/beitraege/{$thread->category->slug}/{$thread->id}", $thread->path());
   }

   /** @test */
   public function ein_beitrag_hat_einen_benutzer()
   {
       
       $this->assertInstanceOf('App\User', $this->thread->creator);
   }

   /** @test */
    public function ein_beitrag_hat_mehrere_kommentare()
    {
        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }


    /** @test */
    public function ein_beitrag_kann_einen_kommentar_hinzufügen ()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);

    }

    /** @test */
    public function ein_beitrag_ist_kategorisiert ()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Category', $thread->category);
    }

    /** @test */
    public function ein_beitrag_ist_nicht_mehr_bold_wenn_ein_angemeldeter_user_gelesen_hat ()
    {
        $this->signIn();

        $thread = create('App\Thread');

        tap(auth()->user(), function ($user) use ($thread) {

        $this->assertTrue($thread->hasUpdatesFor($user));

        $user->read($thread);
        

        $this->assertFalse($thread->hasUpdatesFor($user));

        });
        



    }

}
