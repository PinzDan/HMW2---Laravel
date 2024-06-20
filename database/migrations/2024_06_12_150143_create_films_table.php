<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('locandina')->nullable();
            $table->string('trailer')->nullable();
            $table->year('anno_di_rilascio')->nullable();
            $table->decimal('rating', 3, 1)->nullable();
            $table->integer('durata')->nullable();
            $table->string('genere')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('films');
    }
}

