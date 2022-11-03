<?php

use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use App\Models\VehicleType;
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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('job_id');
            $table->foreignIdFor(Service::class, 'service_id');
            $table->foreignIdFor(Customer::class, 'customer_id');
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(VehicleType::class, 'vehicle_type_id');
            $table->integer('status');
            $table->string('plate_number');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::dropIfExists('jobs');
    }
};
