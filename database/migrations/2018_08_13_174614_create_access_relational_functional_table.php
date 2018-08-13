<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessRelationalFunctionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_relational_functional', function (Blueprint $table) {
            //
            $table->integer('aid')->comment('权限ID');
            $table->integer('fid')->comment('功能操作ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_relational_functional', function (Blueprint $table) {
            //
        });
    }
}
