<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

test('action::logout - it can successfully log out a user', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('login.view'));
});
