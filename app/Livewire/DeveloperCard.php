<?php

namespace App\Livewire;

use App\Models\Developer;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeveloperCard extends Component
{
    public Developer $developer;

    public function mount(Developer $developer): void
    {
        $this->developer = $developer;
    }

    public function render(): View
    {
        return view('livewire.developer-card');
    }

    public function favorite(): void
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            Favorite::query()->firstOrCreate([
                'developer_github_id' => $this->developer->github_id,
                'user_id' => $user->id,
            ]);

            $this->developer->is_favorite = true;
            $this->dispatch('action::favoritted', github_id: $this->developer->github_id);
        }
    }

    public function unfavorite(): void
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            /** @var Favorite $favorite */
            $favorite = Favorite::query()->where('developer_github_id', $this->developer->github_id)
                ->where('user_id', $user->id)
                ->first();

            if ($favorite->exists) {
                $favorite->delete();
            }

            $this->developer->is_favorite = false;
            $this->dispatch('action::unfavoritted', github_id: $this->developer->github_id);
        }
    }

    public function shareDeveloper(): void
    {
        $this->dispatch('action::share-developer', developer: $this->developer->id, show: true);
    }
}
