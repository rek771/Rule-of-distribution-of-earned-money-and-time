<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned()->comment('Id связанного пользователя');

            $table->bigInteger('parent_id')->unsigned()->nullable()->comment('ID родительского шаблона');
            $table->bigInteger('child_id')->unsigned()->nullable()->comment('ID дочернего шаблона');

            $table->integer('description')->comment('Описание шаблона');

            $table->integer('days_count')->nullable()->unsigned()->comment('Колличество дней в шаблоне');
            $table->integer('weeks_count')->nullable()->unsigned()->comment('Колличество недель в шаблоне');
            $table->integer('months_count')->nullable()->unsigned()->comment('Колличество месяцев в шаблоне');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('parent_id')->references('id')->on('template_plans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('child_id')->references('id')->on('template_plans')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_plans');
    }
}
