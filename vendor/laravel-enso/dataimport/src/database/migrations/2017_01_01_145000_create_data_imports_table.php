<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataImportsTable extends Migration
{
    public function up()
    {
        Schema::create('data_imports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('original_name');
            $table->string('saved_name');
            $table->string('comment')->nullable();
            $table->json('summary');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_imports');
    }
}
