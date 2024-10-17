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
        Schema::create('ticket_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name', 31)->unique();
            $table->string('type', 15);
            $table->boolean('book_time')->default(false);
            $table->string('url', 255);
            $table->string('login', 63);
            $table->string('password', 63);
            $table->text('public_key');
            $table->text('private_key');
            $table->string('ticketurl', 255);
            $table->string('oauth_consumer_key', 100)->nullable();
            $table->string('oauth_consumer_secret', 4000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_systems');
    }
};
