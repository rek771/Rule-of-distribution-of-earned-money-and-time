<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned()->comment('Id связанного пользователя');
            $table->bigInteger('source_plans_id')->nullable()->unsigned()->comment('ID родительского плана');

            $table->date('plan_date_start')->comment('Дата начала плана');
            $table->date('plan_date_end')->nullable()->comment('Дата окончания плана');

            $table->foreign('source_plans_id')->references('id')->on('plans')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
