<?php

namespace App\Livewire;

use App\Models\Developer;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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
                $query->where('user_id', auth()->id());
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
}
