<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('exhibits', function (Blueprint $table) {
        $table->id();
        $table->foreignId('hall_id')->constrained()->cascadeOnDelete();
        $table->string('title')->unique();
        $table->string('author');
        $table->integer('year');
        $table->text('description')->nullable();
        $table->boolean('is_published')->default(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibits');
    }
};
