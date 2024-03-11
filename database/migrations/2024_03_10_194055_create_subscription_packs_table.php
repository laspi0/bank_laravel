<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPacksTable extends Migration
{
    public function up()
    {
        Schema::create('subscription_packs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('agio', 10, 2); // Example: 2.5%
            $table->decimal('ceiling', 15, 2);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_packs');
    }
}
