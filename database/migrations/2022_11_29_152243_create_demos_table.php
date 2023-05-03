<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demos', function (Blueprint $table) {
            $table->id();
            $table->string('visitorID')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('host');
            $table->string('purpose');
            $table->string('pic');
            $table->text('address');
            $table->tinyInteger('is_deleted')->default('0');
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
        Schema::dropIfExists('demos');
    }
}
