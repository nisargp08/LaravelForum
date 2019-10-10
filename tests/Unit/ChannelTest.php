<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ChannelTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAChannelConsistsOfThreads()
    {
        $channel = create('App\Channel');
        $thread = create('App\Thread', ['channel_id' => $channel->id]);

        $this->assertTrue($channel->threads->contains($thread));
    }
}
