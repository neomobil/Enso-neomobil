<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('commentable');
            $table->text('body');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->integer('updated_by')->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
