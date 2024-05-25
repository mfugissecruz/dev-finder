<?php

namespace App\Traits;

use App\Helper\ValidateType;
use Illuminate\Support\Collection;

trait DeveloperData
{
    /** @var Collection<string, mixed> */
    private Collection $data;

    /**
     * Initialize the developer data.
     *
     * @param  array<string, mixed>  $data
     */
    public function initialize(array $data): void
    {
        $this->data = collect($data);
    }

    public function getLogin(): string
    {
        return ValidateType::string($this->data->get('login'));
    }

    public function getId(): int
    {
        return ValidateType::integer($this->data->get('id'));
    }

    public function getNodeId(): string
    {
        return ValidateType::string($this->data->get('node_id'));
    }

    public function getAvatarUrl(): string
    {
        return ValidateType::string($this->data->get('avatar_url'));
    }

    public function getGithubUrl(): string
    {
        return ValidateType::string($this->data->get('html_url'));
    }

    public function getEmail(): ?string
    {
        return ValidateType::nullableString($this->data->get('email'));
    }

    public function getBlog(): ?string
    {
        return ValidateType::nullableString($this->data->get('blog'));
    }

    public function getBio(): ?string
    {
        return ValidateType::nullableString($this->data->get('bio'));
    }

    public function getCompany(): ?string
    {
        return ValidateType::nullableString($this->data->get('company'));
    }

    public function getLocation(): ?string
    {
        return ValidateType::nullableString($this->data->get('location'));
    }

    public function getPublicRepos(): int
    {
        return ValidateType::integer($this->data->get('public_repos'));
    }

    public function getFollowing(): int
    {
        return ValidateType::integer($this->data->get('following'));
    }

    public function getFollowers(): int
    {
        return ValidateType::integer($this->data->get('followers'));
    }

    public function getGithubCreatedAt(): ?string
    {
        return ValidateType::nullableString($this->data->get('created_at'));
    }
}
