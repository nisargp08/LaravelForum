<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    //public function testBasicTest()
    public function testAUserCanBrowseThreads()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads');
        $response->assertSee($thread->title);
        //$response->assertStatus(200);
    }
    public function testAUserCanClickOnThreads(){
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads/'.$thread->id);
        $response->assertSee($thread->title);
    }
}
