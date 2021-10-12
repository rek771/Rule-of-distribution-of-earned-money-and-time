<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans_tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('plans_id')->unsigned()->nullable()->comment('ID связанного плана');
            $table->bigInteger('tasks_id')->unsigned()->comment('ID связанной задачи');

            $table->string('task_score_type')->comment('Тип объема задачи (базовый, средний, большой)');
            $table->time('planned_time_start')->nullable()->comment('Время начала выполнения');
            $table->time('planned_time_end')->nullable()->comment('Время окончания выполнения');

            $table->foreign('plans_id')->references('id')->on('plans');
            $table->foreign('tasks_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans_tasks');
    }
}
