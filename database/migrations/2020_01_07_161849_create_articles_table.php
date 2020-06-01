<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->text('description');
            $table->string('category');
            $table->decimal('price');
            $table->string('img')->default('./images/noimage.png')->nullable();
            $table->date('date');
            $table->integer('user_id')->default(0);
			$table->integer('views')->default(0);
			$table->integer('likes')->default(0);
			$table->boolean('premium')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
