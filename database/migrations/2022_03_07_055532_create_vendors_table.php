<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{

    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('mobile', 150);
            $table->string('password', 50);
            $table->string('logo', 150);
            $table->text('address', 150);
            $table->string('email', 150)->nullable();
            $table->string('latitude', 150)->nullable();
            $table->string('longitude', 150)->nullable();
            $table->integer('category_id');
            $table->tinyInteger('active')->default(0);
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
        Schema::dropIfExists('vendors');
    }
}
