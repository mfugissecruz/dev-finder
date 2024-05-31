<?php

namespace App\Livewire;

use App\Models\Developer;
use App\Models\SharedProfile;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDefaultDashboard extends Component
{
    /** @var Collection<int, Developer> */
    protected Collection $developers;

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $dev_profiles = SharedProfile::query()->where('user_id', $user->id)->pluck('developer_id')->toArray();

        $this->developers = Developer::query()->whereIn('developers.id', $dev_profiles)->get();
    }

    public function render(): View
    {
        return view('livewire.user-default-dashboard')
            ->with([
                'has_developers' => $this->developers->isNotEmpty(),
                'developers' => $this->developers,
            ]);
    }
}
