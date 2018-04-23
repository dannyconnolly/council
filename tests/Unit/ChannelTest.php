<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;
    
    // protected $thread;

    // public function setUp()
    // {
    //     parent::setUp();

    //     $this->thread = create('App\Thread');
    // }

    /** @test */
    public function a_channel_consists_of_threads()
    {
         $channel = create('App\Channel');
         $thread = create('App\Thread', ['channel_id' => $channel->id]);

         $this->assertTrue($channel->threads->contains($thread));
    }
}
