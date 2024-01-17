<?php

use App\Livewire\Tweet\Create;
use App\Models\Tweet;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;

it('should be able to create a tweet', function () {
    $user = User::factory()->create();

    actingAs($user);

    livewire(Create::class)
        ->set('body', 'This is a tweet')
        ->call('tweet')
        ->assertDispatched('tweet::created');

    assertDatabaseCount('tweets', 1);

    expect(Tweet::first())
        ->body->toBe('This is a tweet')
        ->created_by->toBe($user->id);

});

it('should make sure that only authenticated users can tweet', function () {
    livewire(Create::class)
        ->set('body', 'This is a tweet')
        ->call('tweet')
        ->assertForbidden();

    actingAs(User::factory()->create());

    livewire(Create::class)
        ->set('body', 'This is a tweet')
        ->call('tweet')
        ->assertDispatched('tweet::created');
});

test('body is required', function () {
    actingAs(User::factory()->create());

    livewire(Create::class)
        ->set('body', null)
        ->call('tweet')
        ->assertHasErrors(['body' => 'required']);
});

todo('the tweet should have a max length of 140 characters');
todo('should show the tweet on the timeline');
