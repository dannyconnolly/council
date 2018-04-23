<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function a_notification_is_prepared_when_a_subscribed_thread_recieves_new_reply_that_is_not_by_the_current_user()
    {
        $thread = create('App\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'This is a new reply'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);
        
        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'This is a new reply'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fetch_their_unread_notifications()
    {
        create(DatabaseNotification::class);

        $this->assertCount(1, $this->getJson(route('user-notifications', auth()->user()->name))->json());

    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        create(DatabaseNotification::class);

        tap(auth()->user(), function ($user) {
            $this->assertCount(1, $user->unreadNotifications);

            $this->delete(route('user-notification.destroy', [$user->name, $user->unreadNotifications->first()->id]));
            
            $this->assertCount(0, $user->fresh()->unreadNotifications);
        });       
    }
}
