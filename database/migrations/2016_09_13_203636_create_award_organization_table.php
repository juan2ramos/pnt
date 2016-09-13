<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_organization', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('organization_id')->unsigned();
            $table->integer('award_id')->unsigned();
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('award_id')->references('id')->on('awards');

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
        Schema::drop('award_organization');
    }
}
