<?php

namespace Tests\Feature;

use App\Activity;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    function gäste_können_keine_beiträge_erstellen ()
    {

        $this->withExceptionHandling();

        $this->get('/beitraege/create')
            ->assertSee('/login');

        $this->post('/beitraege')
            ->assertRedirect('/login');

    }

    /** @test */
    function ein_angemeldeter_user_kann_beiträge_erstellen ()
    {
    
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post('/beitraege', $thread->toArray());


        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }

    /** @test */
    function ein_beitrag_braucht_einen_titel ()
    {

        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

     /** @test */
     function ein_beitrag_braucht_einen_text ()
     {
 
         $this->publishThread(['body' => null])
             ->assertSessionHasErrors('body');
     }

     /** @test */
     function ein_beitrag_braucht_eine_valide_kategorie ()
     {
        factory('App\Category', 2)->create();

        $this->publishThread(['category_id' => null])
             ->assertSessionHasErrors('category_id');

        $this->publishThread(['category_id' => 999])
            ->assertSessionHasErrors('category_id');
     }

     /** @test */
     function nicht_angemeldete_user_können_keine_beiträge_löschen ()
     {
        $this->withExceptionHandling();

        $thread = create('App\Thread');

        $this->delete($thread->path())->assertRedirect('/login');

        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);

     }

     /** @test */
     function angemeldete_user_können_beiträge_löschen ()
     {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);


        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        $this->assertEquals(0, Activity::count());

     }

     
    /** @test */
    public function publishThread($overrides = [])
    {

        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);

         return $this->post('/beitraege', $thread->toArray());

    }

}
