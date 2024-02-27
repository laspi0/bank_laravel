<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->nullable()->unique();
            $table->string('branch_number')->nullable();
            $table->string('function')->nullable(); // Account function
            $table->string('address')->nullable(); // Account holder's address
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('national_id')->nullable(); // ID card photo
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->enum('account_type', ['savings', 'current'])->nullable();
            $table->enum('account_status', ['active', 'blocked'])->default('active');
            $table->enum('profile_type', ['admin', 'teller', 'client'])->default('admin');
            $table->decimal('balance', 10, 2)->default(0); // Balance of the account, with 10 digits in total and 2 after the decimal point
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
