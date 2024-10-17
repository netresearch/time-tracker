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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_system_id')->constrained('ticket_systems');
            $table->string('ticket_number', 31);
            $table->string('name', 127);
            $table->integer('estimation')->nullable();
            $table->string('parent', 31)->nullable();
            $table->timestamps();

            $table->unique(['ticket_system_id', 'ticket_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
