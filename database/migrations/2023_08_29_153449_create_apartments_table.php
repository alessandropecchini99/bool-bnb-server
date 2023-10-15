<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name', 200)->nullable(false);
            $table->string('slug')->unique()->nullable(false);
            $table->unsignedinteger('rooms')->nullable(false);
            $table->unsignedinteger('beds')->nullable(false);
            $table->unsignedinteger('bathrooms')->nullable(false);
            $table->unsignedinteger('square_meters')->nullable(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_sponsored')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('apartments');
    }
};
