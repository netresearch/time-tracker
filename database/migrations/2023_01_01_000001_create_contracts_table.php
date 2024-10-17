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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->float('hours_0')->default(0.0);
            $table->float('hours_1')->default(8.0);
            $table->float('hours_2')->default(8.0);
            $table->float('hours_3')->default(8.0);
            $table->float('hours_4')->default(8.0);
            $table->float('hours_5')->default(8.0);
            $table->float('hours_6')->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
