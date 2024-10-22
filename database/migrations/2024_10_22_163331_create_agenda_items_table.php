<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agenda_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->time('time');
            $table->string('title');
            $table->text('description');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_items');
    }
};
