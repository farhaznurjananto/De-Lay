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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title', 20);
            $table->string('image_path');
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->string('advertising_package', 5);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('status')->default(false);
            $table->foreignId('owner_id')->references('id')->on('users');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
