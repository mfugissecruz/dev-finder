<?php

namespace App\Livewire;

use App\Models\Developer;
use App\Services\GitHubService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    public ?string $username = null;

    public ?string $language = null;

    public ?string $location = null;

    public int $per_page = 15;

    public bool $isLoading = false;

    private GitHubService $github;

    public function boot(): void
    {
        $this->github = new GitHubService;
    }

    /**
     * @return LengthAwarePaginator<Developer>
     */
    #[Computed]
    public function developers(): LengthAwarePaginator
    {
        $developers = Developer::query();

        if (! $developers->count()) {
            $this->loadDataFromGitHub();
        }

        return $developers->paginate($this->per_page);
    }

    public function render(): View
    {
        return view('livewire.dashboard')
            ->with([
                'has_developers' => Developer::query()->exists(),
            ]);
    }

    public function loadMore(): void
    {
        /** @var Developer $latest_developer */
        $latest_developer = Developer::query()->orderByDesc('id')->first();

        /** @var Developer $last_loaded_developer */
        $last_loaded_developer = $this->developers()->last();

        if ($last_loaded_developer->id === $latest_developer->id) {
            $this->dispatch('action::load-more-devs');
            $this->loadDataFromGitHub();
        }

        $this->per_page += 15;
    }

    private function loadDataFromGitHub(): void
    {
        $this->isLoading = true;

        try {
            $this->github->loadMoreDevelopers([
                'username' => $this->username,
                'language' => $this->language,
                'location' => $this->location,
            ]);
        } catch (ConnectionException $e) {
            // Handle exception
        } finally {
            $this->isLoading = false;
            $this->dispatch('action::load-complete');
        }
    }
}
