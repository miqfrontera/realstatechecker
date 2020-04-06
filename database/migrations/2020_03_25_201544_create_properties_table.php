<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('status');
            $table->string('location');
            $table->unsignedInteger('rooms');
            $table->unsignedInteger('bathrooms');
            $table->boolean('has_swimming_pool')->default(false);
            $table->boolean('has_garden')->default(false);
            $table->boolean('has_terrace')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->float('constructed_square_meters')->nullable();
            $table->float('plot_square_meters')->nullable();
			$table->float('price');
			$table->text('link');
			$table->dateTime('sent_at')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
