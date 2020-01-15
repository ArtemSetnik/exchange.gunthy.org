<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiRoleApiKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_role_api_key', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_role_id')->unsigned()->index();
            $table->foreign('api_role_id')->references('id')->on('api_roles')->onDelete('cascade');
            $table->integer('api_key_id')->unsigned()->index();
            $table->foreign('api_key_id')->references('id')->on('api_keys')->onDelete('cascade');
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
        Schema::dropIfExists('api_role_api_key');
    }
}
