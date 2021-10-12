<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned()->unsigned()->comment('Id связанного пользователя');
            $table->bigInteger('parent_id')->unsigned()->nullable()->comment('ID родительской задачи');

            $table->string('description')->comment('Описание задачи');
            $table->integer('priority')->default(0)->comment('Приоритет задачи');

            $table->string('type')->comment('Тип задачи дом/работа/свой');

            $table->boolean('is_resolved')->default(0)->comment('Решена ли задача');
            $table->boolean('is_global')->default(0)->comment('Задача из списка "На будущее"/не создавалась только для плана');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('parent_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
