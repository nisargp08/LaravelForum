<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    protected $thread;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void{
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    function testAThreadHasReplies(){
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->thread->replies);
    }
    function testAThreadHasACreator(){
        $this->assertInstanceOf('App\User',$this->thread->author);
    }
    function testAThreadCanAddReply(){
        $this->thread->addReply([
            'body' => 'Reply Body check insertion',
            'user_id' => 2
        ]);
        //Reply count
        $this->assertCount(1,$this->thread->replies);
    }
}
