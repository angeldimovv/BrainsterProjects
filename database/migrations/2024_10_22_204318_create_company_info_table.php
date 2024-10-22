<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image');
            $table->json('social_media');
            $table->string('hq_address');
            $table->json('employees');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_info');
    }
};
