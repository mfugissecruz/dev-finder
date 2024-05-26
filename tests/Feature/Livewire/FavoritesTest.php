<?php

use App\Livewire\Favorites;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Favorites::class)
        ->assertStatus(200);
});
