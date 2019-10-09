<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use SebastianBergmann\Comparator\Factory;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    public function testGuestCanNotCreateNewThreads(){
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }
    /**
     * A basic feature test to test an authenticated User can create new threads.
     *
     * @return void
     */
    public function testAnAuthenticatedUserCanCreateNewThreads()
    {
        //Make() creates an object instance while raw creates an array
        //Be careful to pass an array in POST request and not a object instance
        //We need an authenticated user
        $this->signIn();
        //That user should be able to create threads
        //When we hit the endpoint to create a new thread
        $thread = make('App\Thread');
        $response = $this->post('/threads',$thread->toArray());
        //Check if the created thread exists in the DB

        //Two approach using assert

        /*$response = $this->get($response->headers->get('Location'));
        $response->assertSee($thread->title)
             ->assertSee($thread->body);*/
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function testAThreadRequiresATitle(){
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }
    public function testAThreadRequiresABody(){
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }
    public function testAThreadRequiresAChannel(){
        //Will create two channels with id 1 and 2
        factory('App\Channel',2)->create();
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
        //Checking with channel id that does not exist
        $this->publishThread(['channel_id' => 3])
            ->assertSessionHasErrors('channel_id');
    }
    public function publishThread($overrides = []){
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread',$overrides);
        return $this->post('/threads',$thread->toArray());
    }
}
