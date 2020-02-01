<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function eine_kategorie_hat_beiträge ()
    {
        $category = create('App\Category');
        $thread = create('App\Thread', ['category_id' => $category->id]);

        $this->assertTrue($category->threads->contains($thread));


    }






}