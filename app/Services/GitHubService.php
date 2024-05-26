<?php

namespace App\Services;

use App\Action\UpdateOrCreateDeveloper;
use App\Helper\DeveloperFomatted;
use App\Helper\ValidateType;
use App\Models\Developer;
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
    public static function developers(?string $username = null, ?string $language = null, ?string $location = null, int $per_page = 6): Collection
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
     * @param array<string, mixed> $developer_data
     *
     * @param int $userId
     *
     * @return Developer
     */
    public static function storeDeveloper(array $developer_data, int $userId): Developer
    {
        /** @var Developer $developer */
        $developer = UpdateOrCreateDeveloper::handle($developer_data);
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
            $query .= " {$username} in:login";
        }

        if ($language) {
            $query .= " language:{$language}";
        }

        if ($location) {
            $query .= " location:{$location}";
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
                'order' => 'random',
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
     *
     * @return Collection<int, Developer>
     */
    private static function mapResponseToDevelopers(array $response): Collection
    {
        return collect($response['items'])
            ->map(function (array $developer): Developer {
                $details = self::developerDetails(ValidateType::string($developer['login']));

                return new Developer(DeveloperFomatted::handle($developer, $details));
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
