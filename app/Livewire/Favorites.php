<?php

namespace App\Livewire;

use App\Models\Developer;
use App\Models\Favorite;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Favorites extends Component
{
    /**
     * @var Collection<int, Developer>
     */
    public Collection $developers;

    public function mount(): void
    {
        $this->developers = Developer::with('favorites')
            ->whereHas('favorites', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();
    }

    public function render(): View
    {
        return view('livewire.favorites')
            ->with([
                'has_developers' => $this->developers->isNotEmpty(),
                'developers' => $this->developers,
            ]);
    }

    #[On('action::unfavoritted')]
    public function removeUnFavorite(int $github_id): void
    {
        Favorite::query()->where('developer_github_id', $github_id)->where('user_id', Auth::id())->delete();
        $this->developers = $this->developers->filter(fn (Developer $developer) => $developer->github_id !== $github_id);
    }
}
