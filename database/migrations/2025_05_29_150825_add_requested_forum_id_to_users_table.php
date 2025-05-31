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
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
    $table->unsignedBigInteger('requested_forum_id')->nullable();
    $table->foreign('requested_forum_id')->references('id')->on('forums')->onDelete('set null');
});

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
    $table->dropForeign(['requested_forum_id']);
    $table->dropColumn('requested_forum_id');
});

        });
    }
};
