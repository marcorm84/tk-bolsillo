<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CreateTransactionsTable extends Migration
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
            $table->string('title');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('category_id');
            $table->double('amount');
            $table->string('description')->nullable();
            $table->date('date')->default(Carbon::now()->format('Y-m-d'));
            $table->date('created_at')->default(Carbon::now()->format('Y-m-d'));
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
