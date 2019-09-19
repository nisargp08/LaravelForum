<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
        $this->thread = factory('App\Thread')->create();
    }
    //public function testBasicTest()
    public function testAUserCanBrowseThreads()
    {
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
        //$response->assertStatus(200);
    }
    public function testAUserCanClickOnThreads(){
        $response = $this->get('/threads/'.$this->thread->id);
        $response->assertSee($this->thread->title);
    }
    public function testAUserCanViewRepliesOnThread(){
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get('/threads/'.$this->thread->id)
            ->assertSee($reply->body);
    }
}
