<?php

namespace Tests\Unit;

use App\Inspections\Spam;
use Tests\TestCase;


class SpamTest extends TestCase
{
    
    /** @test */
    public function überprüft_invaliden_keywords ()
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent reply here'));

        $this->expectException('Exception');

        $spam->detect('yahoo customer support');


    }

    /** @test */
    public function überprüft_tastatur_spam ()
    {
        $spam = new Spam();

        // $this->assertFalse($spam->detect('Innocent reply here'));

        $this->expectException('Exception');

        $spam->detect('Hallo aaaaaaaaa');


    }

    
}