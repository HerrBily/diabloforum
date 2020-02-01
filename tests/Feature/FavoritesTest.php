<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;


class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

     /** @test */
     public function gäste_können_nicht_liken ()
     {
        
         $this->withExceptionHandling()
            ->post('replies/1/favorites')
            ->assertRedirect('/login');

 
     }


    /** @test */
    public function ein_angemeldeter_user_kann_kommentare_endliken ()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $reply->favorite();

        $this->delete('replies/' .$reply->id . '/favorites');
        $this->assertCount(0, $reply->favorites);

    }

    /** @test */
    public function ein_angemeldeter_user_kann_kommentare_liken ()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $this->post('replies/' .$reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);

    }

     /** @test */
     public function ein_angemeldeter_user_kann_einmal_ein_kommentar_liken ()
     {
         $this->signIn();
 
         $reply = create('App\Reply');

         try {

             $this->post('replies/' .$reply->id . '/favorites');
             $this->post('replies/' .$reply->id . '/favorites');

         } catch (\Exception $e) {

            $this->fail('Kann man nicht zweimal setzten');

         }
 
 
         $this->assertCount(1, $reply->favorites);
 
     }

}