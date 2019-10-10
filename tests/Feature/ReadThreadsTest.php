<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Channel;
class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp(): void{
        parent::setUp();
        $this->thread = create('App\Thread');
    }
    //public function testBasicTest()
    public function testAUserCanBrowseThreads()
    {
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
        //$response->assertStatus(200);
    }
    public function testAUserCanClickOnThreads(){
        $response = $this->get($this->thread->path());
        $response->assertSee($this->thread->title);
    }
    public function testAUserCanViewRepliesOnThread(){
        $reply = create('App\Reply',['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }
    public function testAUserCanFilterThreadsAccordingToAChannel(){
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread',['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
}
