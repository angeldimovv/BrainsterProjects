<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blog_comment_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_comment_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('blog_comment_likes', function (Blueprint $table) {
            $table->foreign('blog_comment_id')->references('id')->on('blog_comments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
//            $table->unique(['blog_comment_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_comment_likes');
    }
};
