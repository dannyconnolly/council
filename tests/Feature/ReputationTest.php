<?php

namespace Tests\Feature;

use App\Reputation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function create;

class ReputationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_earns_points_when_they_create_a_thread() 
    {
        $thread = create('App\Thread');
        
        $this->assertEquals(Reputation::THREAD_WAS_PUBLISHED, Reputation::THREAD_WAS_PUBLISHED);
    }
    
    /** @test */
    public function a_user_loses_points_when_they_delete_a_thread() 
    {
        $this->signIn();
        
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        
        $this->assertEquals(Reputation::THREAD_WAS_PUBLISHED, Reputation::THREAD_WAS_PUBLISHED);
        
        $this->delete($thread->path());
        
        $this->assertEquals(0, $thread->creator->fresh()->reputation);
    }
    
    /** @test */
    public function a_user_earns_points_when_they_reply_to_a_thread() 
    {
        $thread = create('App\Thread');
        
        $reply = $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Here is a reply'
        ]);
        
        $this->assertEquals(Reputation::REPLY_POSTED, $reply->owner->reputation);
    }
    
    /** @test */
    public function a_user_loses_points_when_their_reply_to_a_thread_is_deleted() 
    {
        $this->signIn();
       
        $reply = create('App\Reply', ['user_id' => auth()->id()]);
        
        $this->assertEquals(Reputation::REPLY_POSTED, $reply->owner->reputation);
        
        $this->delete(route('replies.destroy',$reply->id));
        
        $this->assertEquals(0, $reply->owner->fresh()->reputation);
    }
    
    /** @test */
    public function a_user_earns_points_when_their_reply_is_marked_best() 
    {
        $thread = create('App\Thread');
        
        $reply = $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Here is a reply'
        ]);
        
        $thread->markBestReply($reply);
        
        $total = Reputation::REPLY_POSTED + Reputation::BEST_REPLY_AWARDED;
        
        $this->assertEquals($total, $reply->owner->reputation);
    }
    
    /** @test */
    public function a_user_earns_points_when_their_reply_is_favorited() 
    {
        $this->signIn();
        
        $thread = create('App\Thread');
        
        $reply = $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Here is a reply'
        ]);
        
        $this->post(route('replies.favorite', $reply->id));
        
        $total = Reputation::REPLY_POSTED + Reputation::REPLY_FAVORITED;
        
        $this->assertEquals($total, $reply->owner->fresh()->reputation);
    }
    
    /** @test */
    public function a_user_loses_points_when_their_favorited_reply_is_unfavorited() 
    {
        $this->signIn();
        
        $reply = create('App\Reply', ['user_id' => auth()->id()]);
        
        $this->post(route('replies.favorite', $reply->id));
        
        $total = Reputation::REPLY_POSTED + Reputation::REPLY_FAVORITED;
        
        $this->assertEquals($total, $reply->owner->fresh()->reputation);
        
        $this->delete(route('replies.favorite', $reply->id));
        
        $total = Reputation::REPLY_POSTED + Reputation::REPLY_FAVORITED - Reputation::REPLY_FAVORITED;
        
        $this->assertEquals($total, $reply->owner->fresh()->reputation);
    }
}
