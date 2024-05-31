<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('github_id')->unique();
            $table->string('name')->nullable();
            $table->string('login')->unique();
            $table->string('node_id')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('email')->nullable();
            $table->string('blog')->nullable();
            $table->text('bio')->nullable();
            $table->string('company')->nullable();
            $table->string('location')->nullable();
            $table->integer('public_repos')->default(0);
            $table->integer('following')->default(0);
            $table->integer('followers')->default(0);
            $table->dateTime('github_created_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('developers');
    }
};
