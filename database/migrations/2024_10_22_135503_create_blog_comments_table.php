<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('replied_to')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('blog_comments', function (Blueprint $table) {
            $table->foreign('blog_id')->references('id')->on('blogs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('replied_to')->references('id')->on('blog_comments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
