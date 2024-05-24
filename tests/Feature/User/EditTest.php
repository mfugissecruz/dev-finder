<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;

test('user::edit - should display the page to update a user', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->get(route('user.edit', ['user' => User::factory()->create()]))
        ->assertSuccessful();
});

test('user::edit - deny access for non-cto users', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('user.edit', ['user' => User::factory()->create()]))
        ->assertForbidden();
});

test('user::edit - only cto user should be able to update a user', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'name' => 'John Doe',
            'role' => 'default',
            'email' => $user->email,
            'email_confirmation' => $user->email,
        ]);

    assertDatabaseMissing('users', [
        'name' => 'John Doe',
        'role' => 'default',
        'email' => $user->email,
    ]);
});

test('user::edit - cto user can not should be able to update yourself', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => $user]), [
            'name' => 'John Doe',
            'role' => 'default',
            'email' => $user->email,
            'email_confirmation' => $user->email,
        ])->assertRedirect(route('user.index'))
        ->assertSessionHas('error', 'You cannot update yourself!');

    assertDatabaseMissing('users', [
        'name' => 'John Doe',
        'role' => 'default',
        'email' => $user->email,
    ]);
});

test('user::edit - name is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'name' => '',
        ])->assertSessionHasErrors([
            'name' => trans('validation.required', ['attribute' => 'name']),
        ]);
});

test('user::edit - name must be no longer than 255 characters', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'name' => str_repeat('a', 256),
        ])->assertSessionHasErrors([
            'name' => trans('validation.max.string', ['attribute' => 'name', 'max' => 255]),
        ]);
});

test('user::edit - role is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'role' => '',
        ])->assertSessionHasErrors([
            'role' => trans('validation.required', ['attribute' => 'role']),
        ]);
});

test('user::edit - role value should be in default and cto', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'role' => 'anything',
        ])->assertSessionHasErrors([
            'role' => trans('validation.in', ['attribute' => 'role']),
        ]);
});

test('user::edit - email is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'email' => '',
        ])->assertSessionHasErrors([
            'email' => trans('validation.required', ['attribute' => 'email']),
        ]);
});

test('user::edit - email must be a valid format.', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'email' => 'joedoe.com',
        ])->assertSessionHasErrors([
            'email' => trans('validation.email', ['attribute' => 'email']),
        ]);
});

test('user::edit - email must be no longer than 255 characters', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'email' => str_repeat('a', 256),
        ])->assertSessionHasErrors([
            'email' => trans('validation.max.string', ['attribute' => 'email', 'max' => 255]),
        ]);
});

test('user::edit - email must be unique.', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    $other_user = User::factory()->create();

    actingAs($user)
        ->put(route('user.update', ['user' => $other_user]), [
            'email' => $user->email,
            'email_confirmation' => $user->email,
        ])->assertSessionHasErrors([
            'email' => trans('validation.unique', ['attribute' => 'email']),
        ]);
});

test('user::edit - email_confirmation is required', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'email_confirmation' => '',
        ])->assertSessionHasErrors([
            'email_confirmation' => trans('validation.required', ['attribute' => 'email confirmation']),
        ]);
});

test('user::edit - email_confirmation must be a valid format.', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'email_confirmation' => 'joedoe.com',
        ])->assertSessionHasErrors([
            'email_confirmation' => trans('validation.email', ['attribute' => 'email confirmation']),
        ]);
});

test('user::edit - email_confirmation must be no longer than 255 characters', function () {
    $user = User::factory()->create([
        'role' => 'cto',
    ]);

    actingAs($user)
        ->put(route('user.update', ['user' => User::factory()->create()]), [
            'email_confirmation' => str_repeat('a', 256),
        ])->assertSessionHasErrors([
            'email_confirmation' => trans('validation.max.string', ['attribute' => 'email confirmation', 'max' => 255]),
        ]);
});
