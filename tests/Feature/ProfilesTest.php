<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ProfilesTest extends TestCase
{

  use DatabaseMigrations;

  /** @test */
  public function ein_user_hat_ein_profil ()
  {
      $user =create('App\User');

      $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
  }

  /** @test */
  public function user_profil_zeigt_eigene_erstellte_beiträge ()
  {
      $this->signIn();

      $thread = create('App\Thread', ['user_id' => auth()->id()]);

      $this->get("/profiles/". auth()->user()->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
  }

}