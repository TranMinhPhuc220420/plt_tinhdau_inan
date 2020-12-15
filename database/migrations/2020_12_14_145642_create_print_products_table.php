<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_products', function (Blueprint $table) {
            $table->id();
            $table->string('PrintProduct_Name');
            $table->json('PrintProduct_ListImage');
            $table->json('PrintProduct_ListPrice');
            $table->unsignedInteger('FkPrintCategory_id')->default(200520);
            $table->text('PrintProduct_Sapo');
            $table->integer('PrintProduct_Vote')->default(0);
            $table->longText('PrintProduct_Description');
            $table->longText('PrintProduct_Info');
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
        Schema::dropIfExists('print_products');
    }
}
