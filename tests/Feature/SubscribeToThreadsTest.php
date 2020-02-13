<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SubscribeToThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function ein_user_kann_beiträge_abonnieren ()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->post($thread->path() .'/subscriptions');

        $this->assertCount(1, $thread->fresh()->subscriptions);


    }


    /** @test */
    public function ein_user_kann_beiträge_deabonnieren ()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $thread->subscribe();

        $this->delete($thread->path() .'/subscriptions');

        $this->assertCount(0, $thread->subscriptions);

    }





}
