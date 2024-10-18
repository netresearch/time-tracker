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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->time('start');
            $table->time('end');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('project_id')->nullable()->constrained('projects');
            $table->foreignId('account_id')->nullable()->constrained('accounts');
            $table->foreignId('activity_id')->nullable()->constrained('activities');
            $table->string('ticket', 32);
            $table->integer('worklog_id')->nullable();
            $table->string('description', 255);
            $table->integer('duration');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->tinyInteger('class')->unsigned()->default(0);
            $table->boolean('synced_to_ticketsystem')->default(false);
            $table->string('internal_jira_ticket_original_key', 50)->nullable();
            $table->timestamps();

            $table->index('project_id');
            $table->index('user_id');
            $table->index('account_id');
            $table->index('activity_id');
            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
