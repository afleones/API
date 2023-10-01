<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('master')->create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('codename', 40)->comment('Codigo encriptado de la empresa')->collation('utf8mb3_general_ci');
            $table->bigInteger('id_users')->default(0);
            $table->string('dbprefix', 6)->nullable()->default('maite')->comment('Prefijo del nombre de la BD')->collation('utf8mb3_general_ci');
            $table->string('dbsufix', 15)->nullable()->default(null)->comment('Sufijo del nombre de la BD')->collation('utf8mb3_general_ci');
            $table->bigInteger('id_plans')->nullable()->comment('Plan maite de la empresa');
            $table->string('tokenapi', 50)->nullable()->default(null)->collation('utf8mb3_general_ci');
            $table->char('id_states', 1)->nullable()->default('1')->comment('Estado del plan del cliente')->collation('utf8mb3_general_ci');

            $table->timestamps();
            $table->charset = 'utf8mb3';
            $table->collation = 'utf8mb3_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('master')->dropIfExists('accounts');
    }
};
