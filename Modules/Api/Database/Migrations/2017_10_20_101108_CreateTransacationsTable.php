<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('transaction_type_id')->index();
            $table->unsignedInteger('exchange_rate_id')->index();
            $table->decimal('amount', 30, 2);
            $table->string('transaction_code')->unique()->index();
            $table->string('remarks')->nullable();

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->engine = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
