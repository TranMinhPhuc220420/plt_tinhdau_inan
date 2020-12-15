<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_categories', function (Blueprint $table) {
            $table->id();
            $table->string('PrintCategory_Name');
            $table->unsignedInteger('FkPrintType_id')->default(200520);
            $table->string('PrintCategory_Image');
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
        Schema::dropIfExists('print_categories');
    }
}
