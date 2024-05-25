<?php

namespace App\Action;

use App\Helper\ValidateType;
use App\Models\Developer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UpdateOrCreateDeveloper
{
    /**
     * Store developer in the database
     *
     * @param  array<string, mixed>  $developer_data
     *
     * @return Builder|Model
     */
    public static function handle(array $developer_data): Builder|Model
    {
        return Developer::query()->updateOrCreate(
            ['github_id' => $developer_data['id']],
            [
                'name' => $developer_data['name'] ?? null,
                'login' => $developer_data['login'],
                'node_id' => $developer_data['node_id'],
                'avatar_url' => $developer_data['avatar_url'],
                'github_url' => $developer_data['html_url'],
                'email' => $developer_data['email'] ?? null,
                'blog' => $developer_data['blog'] ?? null,
                'bio' => $developer_data['bio'] ?? null,
                'company' => $developer_data['company'] ?? null,
                'location' => $developer_data['location'] ?? null,
                'public_repos' => $developer_data['public_repos'] ?? 0,
                'following' => $developer_data['following'] ?? 0,
                'followers' => $developer_data['followers'] ?? 0,
                'github_created_at' => isset($developer_data['created_at']) ? Carbon::parse(ValidateType::string($developer_data['created_at']))->format('Y-m-d H:i:s') : null,
                'last_synced_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
    }
}
