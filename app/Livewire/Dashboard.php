<?php

namespace App\Livewire;

use App\Models\Developer;
use App\Models\User;
use App\Services\GitHubService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public int $per_page = 9;

    public ?string $username = null;

    public ?string $language = null;

    public ?string $location = null;

    /**
     * @var Collection<int, Developer>
     */
    protected Collection $developers;

    private GitHubService $github;

    public function boot(GitHubService $github): void
    {
        $this->developers = collect();
        $this->github = $github;
    }

    /**
     * @throws ConnectionException
     */
    public function mount(): void
    {
        $this->fetchDevelopers();
    }

    public function render(): View
    {
        return view('livewire.dashboard')->with([
            'has_developers' => $this->developers->isNotEmpty(),
            'developers' => $this->developers,
        ]);
    }

    /**
     * @throws ConnectionException
     */
    public function developerDetail(string $username): void
    {
        $developer = $this->github->developerDetails($username);
    }

    /**
     * @throws ConnectionException
     */
    public function favoriteDeveloper(string $username): void
    {
        $developer = $this->github->developerDetails($username);

        if ($developer && Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            $this->github->storeDeveloper($developer, $user->id);
        }
    }

    /**
     * @throws ConnectionException
     */
    public function fetchDevelopers(): void
    {
        $this->developers = $this->github->developers(
            $this->username,
            $this->language,
            $this->location,
            $this->per_page,
        );
    }

//    public function sharedDeveloper(int $developer_id): void
//    {
//        // Implement shared developer logic
//    }
}
