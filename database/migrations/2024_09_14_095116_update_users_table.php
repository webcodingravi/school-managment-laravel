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
        $table->string('last_name')->nullable()->after('name');
           $table->string('admission_number')->nullable()->after('user_type');
           $table->string('roll_number')->nullable()->after('admission_number');
           $table->integer('class_id')->nullable()->after('roll_number');
           $table->string('gender')->nullable()->after('class_id');
           $table->date('date_of_birth')->nullable()->after('gender');
           $table->string('caste')->nullable()->after('date_of_birth');
           $table->string('mobile_number')->nullable()->after('caste');
           $table->string('religion')->nullable()->after('mobile_number');
           $table->date('admission_date')->nullable()->after('mobile_number');
           $table->string('profile_pic')->nullable()->after('admission_date');
           $table->string('blood_group')->nullable()->after('profile_pic');
           $table->string('height')->nullable()->after('blood_group');
           $table->string('weight')->nullable()->after('height');
           $table->string('occupation')->nullable()->after('weight');
           $table->string('address')->nullable()->after('occupation');
           $table->integer('status')->default(1)->after('occupation');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('admission_number');
            $table->dropColumn('roll_number');
            $table->dropColumn('class_id');
            $table->dropColumn('gender');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('caste');
            $table->dropColumn('mobile_number');
            $table->dropColumn('admission_date');
            $table->dropColumn('profile_pic');
            $table->dropColumn('blood_group');
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('status');

        });
    }
};
