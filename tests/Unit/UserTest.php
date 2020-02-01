<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class Usertest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function ein_user_kann_sein_neuen_kommentar_holen ()
    {
      $user = create('App\User');

      $reply = create('App\Reply', ['user_id' => $user->id]);

      $this->assertEquals($reply->id, $user->lastReply->id);

    }
}