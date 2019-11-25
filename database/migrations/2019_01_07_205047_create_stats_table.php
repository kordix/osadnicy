<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('wood')->default(200);
            $table->float('stone')->default(200);
            $table->float('iron')->default(200);
            $table->float('gold')->default(0);
            $table->float('woodLevel')->default(1);
            $table->float('stoneLevel')->default(1);
            $table->float('ironLevel')->default(1);
            $table->integer('woodStore')->default(1);
            $table->integer('stoneStore')->default(1);
            $table->integer('ironStore')->default(1);
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
        Schema::dropIfExists('stats');
    }
}
