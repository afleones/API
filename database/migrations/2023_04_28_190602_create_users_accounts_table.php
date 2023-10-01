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
        Schema::connection('master')->create('users_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_accounts');
            $table->char('state', 1)->nullable()->default('1');
            //$table->primary(['id_users', 'id_accounts']);
            $table->index('state');
            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_accounts')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('master')->dropIfExists('users_accounts');
    }
};
