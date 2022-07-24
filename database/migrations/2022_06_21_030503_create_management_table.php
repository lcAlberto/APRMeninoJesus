<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('duration'); // quanto q eh pra durar o mandato
            $table->boolean('isCurrent');

            $table->foreignId('organization_id')->constrained('organizations');
            $table->foreignId('president_id')->constrained('users');
            $table->foreignId('vice_president_id')->constrained('users');
            $table->foreignId('treasurer_id')->constrained('users');
            $table->foreignId('vice_treasurer_id')->constrained('users');

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
        Schema::dropIfExists('management');
    }
}
