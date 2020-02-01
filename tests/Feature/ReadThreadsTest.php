<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp ()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }
    /** @test */
    public function ein_user_kann_alle_beitraege_ansehen()
    {
        
        $this->get('/beitraege')
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function ein_user_kann_einen_beitrag_ansehen()
    {
        
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function ein_user_kann_kommentare_lesen_die_zu_einem_beitrag_gehören()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);

    }

     /** @test */
     public function ein_user_kann_beiträge_filtern ()
     {
        $category = create('App\Category');
        $threadInCategory = create('App\Thread', ['category_id' => $category->id]);
        $threadNotInCategory = create('App\Thread');

        $this->get('/beitraege/' . $category->slug)
            ->assertSee($threadInCategory->title)
            ->assertDontSee($threadNotInCategory->title);
 
     } 

     /** @test */
     public function ein_user_kann_beiträge_nach_usernamen_filtern ()
     {
        $this->signIn(create('App\User', ['name' => 'TheBoy']));

        $threadByBoy = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByBoy = create('App\Thread');

        $this->get('beitraege?by=TheBoy')
            ->assertSee($threadByBoy->title)
            ->assertDontSee($threadNotByBoy->title);
 
     } 

     /** @test */
     public function ein_user_kann_beiträge_filtern_nach_ihrer_beliebtheit ()
     {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('beitraege?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response['data'], 'replies_count'));
 
     } 

     /** @test */
    //  public function ein_user_kann_alle_beiträge_anfragen ()
    //  {
    //     $thread = create('App\Thread');
    //     create('App\Reply', ['thread_id' => $thread->id], 2);

    //     $response = $this->getJson($thread->path() . '/replies')->json();

    //     $this->assertCount(1, $response['data']);
    //     $this->assertEquals(2, $response['total']); 

    //  } 
}
