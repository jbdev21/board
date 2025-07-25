<?php

use App\Enums\CurrencyCodeEnum;
use App\Enums\EmploymentTypeEnum;
use App\Enums\PositionStatusEnum;
use App\Enums\SalaryTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SeniorityEnum;
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
        Schema::table('positions', function (Blueprint $table) {
            $table->enum("status", PositionStatusEnum::values())->change()->default('pending');
            $table->bigInteger('external_id')->unique()->nullable(); 
            $table->string('company')->nullable();
            $table->string('office')->nullable();
            $table->boolean('is_remote')->default(0);
            $table->enum('employment_type', EmploymentTypeEnum::values());
            $table->enum('seniority', SeniorityEnum::values()); 
            $table->enum('schedule', ScheduleEnum::values())->nullable(); 
            $table->string('years_of_experience')->nullable(); 
            $table->text('keywords')->nullable(); 

            // Salary (optional)
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->enum('salary_currency_code', CurrencyCodeEnum::values())->nullable();
            $table->enum('salary_type', SalaryTypeEnum::values())->nullable();

            $table->timestamp('external_created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->dropColumn('external_id'); 
            $table->dropColumn('company');
            $table->dropColumn('office');
            $table->dropColumn('is_remote');
            $table->dropColumn('employment_type');
            $table->dropColumn('seniority'); 
            $table->dropColumn('schedule'); 
            $table->dropColumn('years_of_experience'); 
            $table->dropColumn('keywords'); 

            // Salary (optional)
            $table->dropColumn('salary_min');
            $table->dropColumn('salary_max');
            $table->dropColumn('salary_currency_code');
            $table->dropColumn('salary_type');

            $table->dropColumn('external_created_at');
        });
    }
};
