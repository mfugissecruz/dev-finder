<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('github_id')->unique();
            $table->string('login');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('blog')->nullable();
            $table->string('location')->nullable();
            $table->string('avatar_url')->nullable();
            $table->text('bio')->nullable();
            $table->integer('public_repos')->default(0);
            $table->integer('followers')->default(0);
            $table->integer('following')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('developers');
    }
};
