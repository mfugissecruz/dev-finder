<?php

namespace App\Services;

use App\Helper\ValidateType;
use App\Models\Developer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Class GithubService
 */
class GitHubService
{
    /**
     * Get developers from GitHub API
     *
     * @return Collection<int, Developer>
     *
     * @throws ConnectionException
     */
    public static function developers(?string $username = null, ?string $language = null, ?string $location = null, int $per_page = 9): Collection
    {
        $query = self::buildQuery($username, $language, $location);
        $response = self::getResponse($query, $per_page);

        return self::mapResponseToDevelopers($response);
    }

    /**
     * Get developer details from GitHub API
     *
     * @return array<string, mixed>
     *
     * @throws ConnectionException
     */
    public static function developerDetails(string $username): array
    {
        $response = Http::withToken(self::token())
            ->baseUrl('https://api.github.com/')
            ->get("users/{$username}")
            ->json();

        if (! is_array($response)) {
            throw new RuntimeException('Invalid response from GitHub API');
        }

        return $response;
    }

    /**
     * Store developer in the database
     *
     * @param  array<string, mixed>  $developerData
     * @param  int  $userId
     * @return Builder|Model
     */
    public static function storeDeveloper(array $developerData, int $userId): Builder|Model
    {
        $developer = Developer::updateOrCreate(
            ['github_id' => $developerData['id']],
            [
                'name' => $developerData['name'] ?? null,
                'login' => $developerData['login'],
                'node_id' => $developerData['node_id'],
                'avatar_url' => $developerData['avatar_url'],
                'github_url' => $developerData['html_url'],
                'email' => $developerData['email'] ?? null,
                'blog' => $developerData['blog'] ?? null,
                'bio' => $developerData['bio'] ?? null,
                'company' => $developerData['company'] ?? null,
                'location' => $developerData['location'] ?? null,
                'public_repos' => $developerData['public_repos'] ?? 0,
                'following' => $developerData['following'] ?? 0,
                'followers' => $developerData['followers'] ?? 0,
                'github_created_at' => isset($developerData['created_at']) ? Carbon::parse($developerData['created_at'])->format('Y-m-d H:i:s') : null,
                'last_synced_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        $developer->favorites()->updateOrCreate(['user_id' => $userId]);

        return $developer;
    }

    /**
     * Build the search query for GitHub API.
     */
    private static function buildQuery(?string $username, ?string $language, ?string $location): string
    {
        $query = 'type:user';

        if ($username) {
            $query .= " $username in:login";
        }

        if ($language) {
            $query .= " language:$language";
        }

        if ($location) {
            $query .= " location:$location";
        }

        return $query;
    }

    /**
     * Get response from GitHub API
     *
     * @return array{items: array<int, array<string, mixed>>}
     *
     * @throws ConnectionException
     */
    private static function getResponse(string $query, int $per_page): array
    {
        $response = Http::withToken(self::token())
            ->baseUrl('https://api.github.com/')
            ->get('search/users', [
                'q' => $query,
                'per_page' => $per_page,
                'sort' => 'followers',
                'order' => 'desc',
            ])->json();

        if (! is_array($response) || ! isset($response['items']) || ! is_array($response['items'])) {
            throw new RuntimeException('Invalid response from GitHub API');
        }

        return $response;
    }

    /**
     * Map response to Developer models
     *
     * @param  array{items: array<int, array<string, mixed>>}  $response
     * @return Collection<int, Developer>
     */
    private static function mapResponseToDevelopers(array $response): Collection
    {
        return collect($response['items'])
            ->map(function (array $developer): Developer {
                $details = self::developerDetails($developer['login']);
                return new Developer([
                    'github_id' => $developer['id'],
                    'login' => $developer['login'],
                    'name' => $details['name'] ?? null,
                    'node_id' => $developer['node_id'],
                    'avatar_url' => $developer['avatar_url'],
                    'github_url' => $developer['html_url'],
                    'email' => $details['email'] ?? null,
                    'blog' => $details['blog'] ?? null,
                    'bio' => $details['bio'] ?? null,
                    'company' => $details['company'] ?? null,
                    'location' => $details['location'] ?? null,
                    'public_repos' => $details['public_repos'] ?? 0,
                    'following' => $details['following'] ?? 0,
                    'followers' => $details['followers'] ?? 0,
                    'github_created_at' => $details['created_at'] ?? null,
                ]);
            });
    }

    /**
     * Get GitHub API token
     */
    private static function token(): string
    {
        return ValidateType::string(config('services.github.token'));
    }
}
