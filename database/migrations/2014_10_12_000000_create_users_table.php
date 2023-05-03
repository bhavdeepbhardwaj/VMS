<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name');
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_phone')->nullable();
            $table->text('qrCode')->nullable();
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->boolean('role');
            $table->boolean('approve')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('api_token')->nullable();
            $table->tinyInteger('is_deleted')->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
