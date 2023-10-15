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
        Schema::create('apartment_sponsorship', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('sponsorship_id');
            $table->foreign('apartment_id')
            ->references('id')
                ->on('apartments')
                ->onDelete('cascade');
            $table->foreign('sponsorship_id')
            ->references('id')
                ->on('sponsorships')
                ->onDelete('cascade');
            $table->dateTime('init_date')->nullable(false);
            $table->dateTime('end_date')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('apartment_sponsorship');
    }
};
