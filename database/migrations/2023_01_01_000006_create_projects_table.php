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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->string('name', 127);
            $table->string('jira_id', 63)->nullable();
            $table->string('jira_ticket', 63)->nullable();
            $table->foreignId('ticket_system')->nullable()->constrained('ticket_systems');
            $table->boolean('active');
            $table->boolean('global')->unsigned()->default(0);
            $table->integer('estimation')->nullable();
            $table->string('offer', 31)->nullable();
            $table->boolean('billing')->default(0);
            $table->string('cost_center', 31)->nullable();
            $table->string('internal_ref', 31)->nullable();
            $table->string('external_ref', 31)->nullable();
            $table->foreignId('project_lead_id')->nullable()->constrained('users');
            $table->foreignId('technical_lead_id')->nullable()->constrained('users');
            $table->string('invoice', 31)->nullable();
            $table->boolean('additional_information_from_external');
            $table->string('internal_jira_project_key', 50)->nullable();
            $table->integer('internal_jira_ticket_system')->nullable();
            $table->text('subtickets')->default('');
            $table->timestamps();

            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
