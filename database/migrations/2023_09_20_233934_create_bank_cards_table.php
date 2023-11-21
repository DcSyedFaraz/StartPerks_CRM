<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id')->unsigned();
            $table->integer('stage')->unsigned();
            $table->integer('bank_id')->unsigned();
            $table->string('card_name', 100)->nullable();
            $table->string('card_name_slug', 100)->nullable();
            $table->text('url')->nullable();
            $table->text('image')->nullable()->default('text');
            $table->boolean('status')->nullable()->default(false);
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
        Schema::dropIfExists('bank_cards');
    }
}
