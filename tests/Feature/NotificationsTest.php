<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsTest extends TestCase
{

    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function neue_notification_wenn_ein_neuer_beitrag_kommentiert_wird()
    {

        $thread = create('App\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Ein Kommentar'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Ein Kommentar'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

     /** @test */
     public function ein_user_kann_seine_ungelesenen_notificationen_anschauen()
     {

        create(DatabaseNotification::class);
      

        $this->assertCount(1, 
            $this->getJson("/profiles/" . auth()->user()->name . "/notifications/")->json());
 
     }




    /** @test */
    public function ein_user_kann_seine_notifactionen_()
    {

        create(DatabaseNotification::class);

        $user = auth()->user();

        tap(auth()->user(), function ($user) {
            
            $this->assertCount(1, $user->unreadNotifications);
    
            $this->delete("/profiles/{$user->name}/notifications/" .$user->unreadNotifications->first()->id);
    
            $this->assertCount(0, $user->fresh()->unreadNotifications);

        });

    }
}
