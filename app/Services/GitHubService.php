<?php

namespace App\Services;

use App\Action\UpdateOrCreateDeveloper;
use App\Helper\ValidateType;
use App\Models\Developer;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GitHubService
{
    protected string $token;

    protected string $baseURL;

    public function __construct()
    {
        $this->token = ValidateType::string(config('services.github.token'));
        $this->baseURL = ValidateType::string(config('services.github.base_url'));
    }

    /**
     * @param  array<string, int|string|null>  $params
     *
     * @throws ConnectionException
     */
    public function loadMoreDevelopers(array $params): void
    {
        $developers = Developer::query()->orderBy('github_id')->get();

        /** @var Developer $latest_developer */
        $latest_developer = $developers->last();

        $params['since'] = $latest_developer->github_id ?? 1;
        $params['per_page'] = 30;

        $developers = $this->getDevelopers($params);
        $this->storeDeveloper($developers);
    }

    /**
     * @param  Collection<int, Developer>  $developers
     *
     * @throws ConnectionException
     */
    private function storeDeveloper(Collection $developers): void
    {
        foreach ($developers as $developer) {
            $data = $this->getDeveloper(ValidateType::string($developer['login']));
            $data = $this->developerData($data);
            UpdateOrCreateDeveloper::handle($data);
        }
    }

    /**
     * @param  array<string, int|string|null>  $params
     * @return Collection<int, Developer>
     */
    private function getDevelopers(array $params): Collection
    {
        $query = $this->buildQuery($params);

        $response = Cache::remember('github_users_' . md5($query), 60 * 60, function () use ($params) {
            return Http::withToken($this->token)
                ->accept('application/vnd.github+json')
                ->baseUrl($this->baseURL)
                ->get('users', $params)
                ->json();
        });

        if (! is_array($response)) {
            $response = [];
        }

        return collect($response);
    }

    /**
     * @param  array<string, int|string|null>  $params
     */
    public function buildQuery(array $params): string
    {
        $query = '';

        if (! empty($params['username'])) {
            $query .= "user:{$params['username']} ";
        }

        if (! empty($params['language'])) {
            $query .= "language:{$params['language']} ";
        }

        if (! empty($params['location'])) {
            $query .= "location:{$params['location']} ";
        }

        if (! empty($params['since'])) {
            $query .= "since:{$params['since']} ";
        }

        return trim($query);
    }

    /**
     * @return Collection<int, Developer>
     *
     * @throws ConnectionException
     */
    private function getDeveloper(string $username): Collection
    {
        $developer = Http::withToken($this->token)
            ->accept('application/vnd.github+json')
            ->baseUrl($this->baseURL)
            ->get("users/{$username}")
            ->json();

        if (! is_array($developer)) {
            $developer = [];
        }

        return collect($developer);
    }

    /**
     * @param  Collection<int, Developer>  $developer
     *
     * @return array<string, int|string|null>
     */
    private function developerData(Collection $developer): array
    {
        return [
            'github_id' => $developer['id'],
            'name' => $developer['name'] ?? null,
            'login' => $developer['login'],
            'node_id' => $developer['node_id'],
            'avatar_url' => $developer['avatar_url'],
            'github_url' => $developer['url'],
            'email' => $developer['email'] ?? null,
            'blog' => $developer['blog'] ?? null,
            'bio' => $developer['bio'] ?? null,
            'company' => $developer['company'] ?? null,
            'location' => $developer['location'] ?? null,
            'public_repos' => $developer['public_repos'] ?? 0,
            'following' => $developer['following'] ?? 0,
            'followers' => $developer['followers'] ?? 0,
            'created_at' => isset($developer['created_at']) ? Carbon::parse(ValidateType::string($developer['created_at']))->format('Y-m-d H:i:s') : null,
            'last_synced_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
