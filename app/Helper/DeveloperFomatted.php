<?php

namespace App\Helper;

class DeveloperFomatted
{
    /**
     * Format developer data
     *
     * @param  array<string, mixed>  $developer
     *
     * @param  array<string, mixed>  $details
     *
     * @return array<string, mixed>
     */
    public static function handle(array $developer, array $details): array
    {
        return [
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
        ];
    }
}
