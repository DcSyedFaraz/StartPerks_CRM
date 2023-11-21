<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundingFormStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_form_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('Type')->unique();
            $table->boolean('prequilifier')->nullable()->default(true);
            $table->boolean('stage_1')->nullable()->default(false);
            $table->boolean('stage_2')->nullable()->default(false);
            $table->boolean('stage_3')->nullable()->default(false);
            $table->boolean('stage_4')->nullable()->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('funding_form_statuses');
    }
}
