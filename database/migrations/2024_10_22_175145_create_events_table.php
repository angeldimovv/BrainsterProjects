<?php

use App\Models\Agenda;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('theme');
            $table->text('description');
            $table->text('objective');
            $table->foreignIdFor(Agenda::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date');
            $table->string('location');
            $table->integer('ticket_price');
            $table->enum('type', ['normal', 'conference'])->default('normal');
            $table->enum('status', ['upcoming', 'finished'])->default('upcoming');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
