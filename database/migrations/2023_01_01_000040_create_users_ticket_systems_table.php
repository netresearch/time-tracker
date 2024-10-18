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
        Schema::create('users_ticket_systems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('no action');
            $table->foreignId('ticket_system_id')->constrained('ticket_systems')->onDelete('cascade')->onUpdate('no action');
            $table->string('accesstoken', 50);
            $table->string('tokensecret', 50);
            $table->boolean('avoidconnection')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_ticket_systems');
    }
};
