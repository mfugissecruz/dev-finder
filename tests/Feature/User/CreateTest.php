<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

test('user::create - should display the page to create a user', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->get(route('user.create'))
        ->assertSuccessful();
});

test('user::create - deny access for non-cto users', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('user.create'))
        ->assertForbidden();
});

test('user::create - only cto user should be able to create a new user', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'name' => 'John Doe',
            'email' => 'jhon@doe',
            'email_confirmation' => 'jhon@doe',
            'role' => 'default',
            'password' => 'password',
        ])
        ->assertRedirectToRoute('user.index');

    assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'jhon@doe',
        'role' => 'default',
    ]);

    assertDatabaseCount('users', 2);
});

test('user::create - name is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'name' => '',
        ])->assertSessionHasErrors([
            'name' => trans('validation.required', ['attribute' => 'name']),
        ]);
});

test('user::create - name must be no longer than 255 characters', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'name' => str_repeat('a', 256),
        ])->assertSessionHasErrors([
            'name' => trans('validation.max.string', ['attribute' => 'name', 'max' => 255]),
        ]);
});

test('user::create - role is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'role' => '',
        ])->assertSessionHasErrors([
            'role' => trans('validation.required', ['attribute' => 'role']),
        ]);
});

test('user::create - role value should be in default and cto', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'role' => 'anything',
        ])->assertSessionHasErrors([
            'role' => trans('validation.in', ['attribute' => 'role']),
        ]);
});

test('user::create - email is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'email' => '',
        ])->assertSessionHasErrors([
            'email' => trans('validation.required', ['attribute' => 'email']),
        ]);
});

test('user::create - email must be a valid format.', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'email' => 'joedoe.com',
        ])->assertSessionHasErrors([
            'email' => trans('validation.email', ['attribute' => 'email']),
        ]);
});

test('user::create - email must be no longer than 255 characters', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'email' => str_repeat('a', 256),
        ])->assertSessionHasErrors([
            'email' => trans('validation.max.string', ['attribute' => 'email', 'max' => 255]),
        ]);
});

test('user::create - email must be unique.', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    $other_user = User::factory()->create();

    actingAs($user)
        ->post(route('user.store'), [
            'email' => $other_user->email,
        ])->assertSessionHasErrors([
            'email' => trans('validation.unique', ['attribute' => 'email']),
        ]);
});

test('user::create - email_confirmation is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'email_confirmation' => '',
        ])->assertSessionHasErrors([
            'email_confirmation' => trans('validation.required', ['attribute' => 'email confirmation']),
        ]);
});

test('user::create - email_confirmation must be a valid format.', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'email_confirmation' => 'joedoe.com',
        ])->assertSessionHasErrors([
            'email_confirmation' => trans('validation.email', ['attribute' => 'email confirmation']),
        ]);
});

test('user::create - email_confirmation must be no longer than 255 characters', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'email_confirmation' => str_repeat('a', 256),
        ])->assertSessionHasErrors([
            'email_confirmation' => trans('validation.max.string', ['attribute' => 'email confirmation', 'max' => 255]),
        ]);
});

test('user::create - password is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->post(route('user.store'), [
            'password' => '',
        ])->assertSessionHasErrors([
            'password' => trans('validation.required', ['attribute' => 'password']),
        ]);
});
