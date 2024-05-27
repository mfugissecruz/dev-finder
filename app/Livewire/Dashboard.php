<?php

namespace App\Livewire;

use App\Helper\ValidateType;
use App\Models\Developer;
use App\Services\GitHubService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public ?string $username = null;

    public ?string $language = null;

    public ?string $location = null;

    public int $per_page = 9;

    public int $page = 1;

    public bool $has_more_pages = true;

    /**
     * @var Collection<int, Developer>
     */
    public Collection $developers;

    private GitHubService $github;

    public function boot(GitHubService $github): void
    {
        $this->github = $github;
        $this->developers = $this->fetchDevelopersFromDatabase();
    }

    public function render(): View
    {
        return view('livewire.dashboard')
            ->with([
                'has_developers' => $this->developers->isNotEmpty(),
                'developers' => $this->developers,
                'has_more_pages' => $this->has_more_pages,
            ]);
    }

    #[On('action::load-more')]
    public function loadMore(): void
    {
        $this->page++;
        $this->per_page += 6;
        $more_developers = Developer::query()->with('favorites')->paginate($this->per_page, ['*'], 'page', $this->page);
        $this->has_more_pages = $more_developers->hasMorePages();
        $this->developers = $this->developers->merge($more_developers);
    }

    #[On('action::favoritted')]
    #[On('action::unfavoritted')]
    public function refreshDevelopers(int $github_id): void
    {
        $this->developers = $this->developers->map(function (Developer $developer) use ($github_id) {
            if ($developer->github_id == $github_id) {
                $developer->is_favorite = ! $developer->is_favorite;
            }

            if (isset($this->username) || isset($this->location) || isset($this->language)) {
                return Developer::query()
                    ->where('login', $this->username)
                    ->orWhere('location', $this->location)
                    ->get();
            }

            return $developer;
        });
    }

    public function search(): void
    {
        $this->dispatch('fetching::developer');
    }

    protected function fetchDevelopersFromDatabase(): Collection
    {
        $developers = Developer::query()->with('favorites')->get();

        if ($developers->isNotEmpty() && Auth::check()) {
            $user = Auth::user();
            $favorites = $user->favorites()->pluck('developer_github_id')->toArray();

            return $developers->map(function (Developer $developer) use ($favorites) {
                $developer->is_favorite = in_array($developer->github_id, $favorites);

                return $developer;
            })->forPage(1, $this->per_page);
        }

        return $developers;
    }

    #[On('fetch::developer')]
    public function fetchDevelopersFromGitHub(): void
    {
        $developers = $this->github->developers($this->username, $this->language, $this->location);

        foreach ($developers as $developer) {
            $data = $this->developerData($developer->toArray());
            $this->github->storeDeveloper($data);
        }

        $this->developers = Developer::query()
            ->with('favorites')
            ->where('login', $this->username)
            ->orWhere('location', $this->location)
            ->get();

        $this->dispatch('fetched::developer');
    }

    private function developerData(array $developer): array
    {
        return [
            'id' => $developer['github_id'],
            'name' => $developer['name'] ?? null,
            'login' => $developer['login'],
            'node_id' => $developer['node_id'],
            'avatar_url' => $developer['avatar_url'],
            'html_url' => $developer['github_url'],
            'email' => $developer['email'] ?? null,
            'blog' => $developer['blog'] ?? null,
            'bio' => $developer['bio'] ?? null,
            'company' => $developer['company'] ?? null,
            'location' => $developer['location'] ?? null,
            'public_repos' => $developer['public_repos'] ?? 0,
            'following' => $developer['following'] ?? 0,
            'followers' => $developer['followers'] ?? 0,
            'github_created_at' => isset($developer['github_created_at']) ? Carbon::parse(ValidateType::string($developer['github_created_at']))->format('Y-m-d H:i:s') : null,
            'last_synced_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
