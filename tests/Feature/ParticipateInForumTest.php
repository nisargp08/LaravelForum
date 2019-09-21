<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function testUnauthenticatedUsersMayNotAddReplies(){
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/1/replies',[]);
    }

    function testAuthenticatedUserMayParticipateInForumThreads(){
        //Given we have a authenticated user
        $user = create('App\User');
        //Authenticating the user
        $this->be($user);
        //And an existing thread
        $thread = create('App\Thread');
        //When a user adds a reply to the thread
        $reply = make('App\Reply');
        $this->post($thread->path().'/replies',$reply->toArray());
        //Then their reply should be visible on the page
         $this->get($thread->path())->assertSee($reply->body);
    }
}
