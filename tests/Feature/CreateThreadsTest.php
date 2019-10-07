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
        $thread = create('App\Thread');
        $this->post('/threads',$thread->toArray());
        //Check if the created thread exists in the DB

        //Two approach using assert

        /*$response = $this->get($thread->path());
        $response->assertSee($thread->title)
             ->assertSee($thread->body);*/
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
