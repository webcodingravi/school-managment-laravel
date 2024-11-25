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
            $table->text('permanent_address')->nullable()->after('address');
            $table->string('qualification')->nullable()->after('permanent_address');
            $table->string('marital_status')->nullable()->after('qualification');
            $table->string('work_experience')->nullable()->after('marital_status');
            $table->text('note')->nullable()->after('work_experience');
            $table->string('religion')->nullable()->after('caste');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('permanent_address');
            $table->dropColumn('qualification');
            $table->dropColumn('marital_status');
            $table->dropColumn('work_experience');
            $table->dropColumn('note');
        });
    }
};
