<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdControlToDatosRelevantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datos_relevantes', function (Blueprint $table) {
            $table->foreignId('id_control')->after('id')->constrained('controles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datos_relevantes', function (Blueprint $table) {
            $table->dropForeign(['id_control']);
            $table->dropColumn('id_control');
        });
    }
}
