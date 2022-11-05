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
            $table->timestamp('created_at'); //timestamps tarihleri tutuyor.
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
