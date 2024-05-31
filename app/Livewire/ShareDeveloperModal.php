<?php

namespace App\Livewire;

use App\Models\Developer;
use App\Models\SharedProfile;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ShareDeveloperModal extends Component
{
    public bool $showModal = false;

    public Developer $developer;

    public ?string $search = null;

    /**
     * @var array<int>
     */
    public array $selected_users = [];

    /**
     * @var Collection<int, User>
     */
    public Collection $users;

    #[On('action::share-developer')]
    public function mount(Developer $developer, bool $show = false): void
    {
        $this->developer = $developer;
        $this->showModal = $show;
        $this->users = User::all();
    }

    public function render(): View
    {
        return view('livewire.share-developer-modal')
            ->with([
                'users' => $this->users,
            ]);
    }

    public function share(): void
    {
        /** @var User $authenticated_user */
        $authenticated_user = Auth::user();

        $users = $this->selected_users;

        foreach ($users as $userId) {
            SharedProfile::query()->create([
                'developer_id' => $this->developer->id,
                'user_id' => $userId,
                'shared_by' => $authenticated_user->id,
            ]);
        }

        $this->closeModal();
    }

    public function closeModal(): void
    {
        $this->reset(['showModal', 'search']);
    }
}
