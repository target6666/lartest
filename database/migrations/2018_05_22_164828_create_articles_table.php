<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('artno', 31)->unique();
            $table->string('name', 255);
            $table->text('desc1')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->boolean('active')->default(0);
            // $table->integer('supplier') own table, since one article can have multiple suppliers
            $table->integer('vol_l')->nullable();
            $table->integer('vol_b')->nullable();
            $table->integer('vol_h')->nullable();
            $table->integer('weight')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
