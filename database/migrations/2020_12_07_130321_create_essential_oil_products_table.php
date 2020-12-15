<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEssentialOilProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essential_oil_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('FkEssentialOilCategory_id');
            $table->string('EssentialOilProduct_Name');
            $table->string('EssentialOilProduct_Vote');
            $table->longText('EssentialOilProduct_Sapo');
            $table->longText('EssentialOilProduct_Description');
            $table->longText('EssentialOilProduct_Info');
            $table->string('EssentialOilProduct_Price');
            $table->string('EssentialOilProduct_Discount');
            $table->json('EssentialOilProduct_ListImage');

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
        Schema::dropIfExists('essential_oil_products');
    }
}
