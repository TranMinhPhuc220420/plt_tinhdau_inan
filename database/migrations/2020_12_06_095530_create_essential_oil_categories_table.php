<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEssentialOilCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essential_oil_categories', function (Blueprint $table) {
            $table->id('id');
            $table->string('EssentialOilCategory_Name');
            $table->string('EssentialOilCategory_Image');
            $table->unsignedInteger('FkEssentialOilType_id')->default(200520);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('essential_oil_categories');
    }
}
