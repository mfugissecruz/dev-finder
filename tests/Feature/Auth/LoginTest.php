<?php

use App\Models\User;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('page::login - it should display the login page', function () {
    get(route('login'))
        ->assertSuccessful();
});

test('page::login - it can successfully log in a user', function () {
    $user = User::factory()->create();

    $response = post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    if ($user->role === 'cto') {
        $response->assertRedirectToRoute('dashboard');
    } else {
        $response->assertRedirectToRoute('default.dashboard');
    }
});

test('page::login - deny access for non-registered users', function () {
    post(route('login.store'), [
        'email' => 'joe@doe',
        'password' => 'password',
    ])->assertRedirectToRoute('login')
        ->assertSessionHasErrors([
            'email' => trans('auth.failed'),
        ]);
});

test('page::login - email is required', function () {
    post(route('login.store'), [
        'email' => '',
    ])->assertSessionHasErrors([
        'email' => trans('validation.required', ['attribute' => 'email']),
    ]);
});

test('page::login - email must be valid', function () {
    post(route('login.store'), [
        'email' => 'email',
    ])->assertSessionHasErrors([
        'email' => trans('validation.email', ['attribute' => 'email']),
    ]);
});

test('page::login - password is required', function () {
    post(route('login.store'), [
        'email' => '',
    ])->assertSessionHasErrors([
        'email' => trans('validation.required', ['attribute' => 'email']),
    ]);
});
