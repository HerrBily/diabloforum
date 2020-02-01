<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ParticipateInThreadsTest extends TestCase
{

  use DatabaseMigrations;

  /** @test */
  function ein_nicht_angemeldeter_user_kann_nicht_kommentieren ()
  {
    $this->withExceptionHandling()
        ->post('/beitraege/some-category/1/replies', [])
        ->assertRedirect('/login');

  }
  
  /** @test */
  function angemeldeter_user_darf_kommentieren ()
  {
      
      $this->be($user = factory('App\User')->create());

      $thread = create('App\Thread');
      $reply = make('App\Reply');

      $this->post($thread->path(). '/replies', $reply->toArray());

      $this->get($thread->path()) 
        ->assertSee($reply->body);
  }

  /** @test */
  function ein_kommentar_benötigt_ein_text ()
  {
    
    $this->withExceptionHandling()->signIn();

    $thread = create('App\Thread');
    $reply = make('App\Reply', ['body' => null]);

    $this->post($thread->path(). '/replies', $reply->toArray())
      ->assertSessionHasErrors('body');
      
  }

  /** @test */
  function  ein_user_und_gäste_können_nicht_andere_kommentare_löschen()
  {
    $this->withExceptionHandling();

    $reply = create('App\Reply');

    $this->delete("/replies/{$reply->id}")
      ->assertRedirect('/login');

      $this->signIn()
        ->delete("/replies/{$reply->id}")
        ->assertStatus(403);
      
  }

   /** @test */
   function  ein_angemeldeter_user_kann_sein_kommenntar_löschen()
   {

    $this->signIn();
    $reply = create('App\Reply', ['user_id' => auth()->id()]);
 
    $this->delete("/replies/{$reply->id}")->assertStatus(302);
 
    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
       
   }

    /** @test */
    function  gäste_können_kein_kommentar_updaten()
    {
 
     $this->withExceptionHandling();
     $reply = create('App\Reply');
 
     $updatedReply = 'Das Kommentar wurde bearbeitet.';
  
     $this->patch("/replies/{$reply->id}")
          ->assertRedirect('login');
  
     $this->signIn()
          ->patch("/replies/{$reply->id}")
          ->assertStatus(403);
        
    }

   /** @test */
   function  ein_angemeldeter_user_kann_sein_kommentar_updaten()
   {

    $this->signIn();
    $reply = create('App\Reply', ['user_id' => auth()->id()]);

    $updatedReply = 'Das Kommentar wurde bearbeitet.';
 
    $this->patch("/replies/{$reply->id}", ['body' => $updatedReply]);
 
    $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $updatedReply]);
       
   }

   /** @test */
   function  kommentare_die_spam_drinnen_haben_werden_nicht_hinzugefügt()
   {

    // $this->withExceptionHandling();
    
    $this->signIn();

    $thread = create('App\Thread');

    $reply = make('App\Reply', [
          'body' => 'Yahoo Customer Support'
        ]);


    $this->post($thread->path(). '/replies', $reply->toArray())
        ->assertStatus(422);
       
   }

  /** @test */
  // function  ein_user_kann_enur_einmal_pro_minute_kommentieren()
  // {
   
  //   $this->signIn();

  //   $thread = create('App\Thread');

  //   $reply = make('App\Reply', [

  //         'body' => 'My simple reply.'
  //   ]);

  //   $this->post($thread->path() . '/replies', $reply->toArray())
  //       ->assertStatus(200);

  //   $this->post($thread->path() . '/replies', $reply->toArray())
  //       ->assertStatus(422);
   
  // }


}
