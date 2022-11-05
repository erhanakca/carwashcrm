<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id('vehicle_types_id')->autoIncrement(); //autoIncrement tabloda id ler otomatik artacak.
            $table->string('name')->unique();  //unique birbirine benzemeyecek.
            $table->integer('price_multiplier')->nullable();
            $table->timestamps(); //timestamps tarihleri tutuyor.
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_types');
    }
};
