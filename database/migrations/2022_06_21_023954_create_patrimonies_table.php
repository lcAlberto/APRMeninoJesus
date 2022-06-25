<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrimonies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(); // número do patrimonio
            $table->string('name');
            $table->string('description');
            $table->string('type');
            $table->string('purchased_value');
            $table->string('current_value');
            $table->timestamp('acquisition_date');
            $table->timestamp('sale_date')->nullable();
            $table->timestamp('license_plate')->nullable(); // placa do veículo
            $table->timestamp('chassis_number')->nullable(); // placa do veículo
            $table->timestamp('brand')->nullable(); // placa do veículo
            $table->timestamp('model')->nullable(); // placa do veículo

            $table->foreignId('organization_id')->constrained('organizations');

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
        Schema::dropIfExists('patrimonies');
    }
}
