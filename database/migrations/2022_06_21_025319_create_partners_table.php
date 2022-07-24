<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf');
            $table->string('rg');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nis')->nullable(); // carteira de trabalho
            $table->string('spouses_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('fathers_name')->nullable();
            $table->boolean('isLiterate'); // é alfabetizado?
            $table->string('scholarity')->nullable(); // escolaridade, null se nao for alfabetizado
            $table->string('marital_status'); // estado civil
            $table->string('born_city')->nullable();
            $table->timestamp('born_date');
            $table->boolean('isCurrentUser'); // e o usuario atual
            $table->boolean('isPresidentUser'); // e o usuario presidente

            $table->string('postal_code')->nullable();

            $table->foreignId('state_id')->nullable()->constrained('states');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->foreignId('user_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('partners');
    }
}
