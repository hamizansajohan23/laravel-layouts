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
            $table->dropColumn('bahagian');
            $table->foreignId('bahagian_id')->nullable()->after('role')->constrained('bahagians')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['bahagian_id']);
            $table->dropColumn('bahagian_id');
            $table->string('bahagian')->nullable()->after('role');
        });
    }
};
