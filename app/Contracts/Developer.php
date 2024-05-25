<?php

namespace App\Contracts;

interface Developer
{
    public function getLogin(): string;
    public function getId(): int;
    public function getNodeId(): string;
    public function getAvatarUrl(): string;
    public function getGithubUrl(): string;
    public function getEmail(): ?string;
    public function getBlog(): ?string;
    public function getBio(): ?string;
    public function getCompany(): ?string;
    public function getLocation(): ?string;
    public function getPublicRepos(): int;
    public function getFollowing(): int;
    public function getFollowers(): int;
    public function getGithubCreatedAt(): ?string;
}
