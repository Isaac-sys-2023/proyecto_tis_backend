<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocatoriaUserRoleTable extends Migration
{
    public function up(): void
    {
        Schema::create('convocatoria_user_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('convocatoria_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('convocatoria_id')
                  ->references('idConvocatoria')
                  ->on('convocatoria')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('role_id')
                  ->references('id')->on(config('permission.table_names.roles'))
                  ->onDelete('cascade');

            $table->unique(['convocatoria_id','role_id','user_id'], 'conv_user_role_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('convocatoria_user_role');
    }
}
