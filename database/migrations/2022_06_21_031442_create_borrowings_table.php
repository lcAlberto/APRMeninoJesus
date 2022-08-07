<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('description')->nullable();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('organization_id')->constrained('organizations');
            $table->foreignId('patrimony_id')->constrained('patrimonies');

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
        Schema::dropIfExists('borrowings');
    }
}
