<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitorID')->unique();
            $table->string('name')->nullable();
            $table->string('companyCode')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('host')->nullable();
            $table->string('purpose')->nullable();
            $table->string('pic')->nullable();
            $table->string('companyLogo')->nullable();
            $table->text('address')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
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
        Schema::dropIfExists('visitors');
    }
}
