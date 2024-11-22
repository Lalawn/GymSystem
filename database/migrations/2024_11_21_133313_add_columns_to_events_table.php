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
        Schema::table('events', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('trainer_id');
        });
        Schema::table('events', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('trainer_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('author_id');
            $table->dropColumn('trainer_id');

            $table->dropForeign(['author_id']);
            $table->dropForeign(['trainer_id']);
        });
    }
};
