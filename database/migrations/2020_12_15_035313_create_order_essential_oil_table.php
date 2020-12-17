<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderEssentialOilTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order_essential_oil', function (Blueprint $table) {
      $table->id();
      $table->string('Order_FullNameUser');
      $table->string('Order_PhoneNumber');
      $table->string('Order_EmailUser')->default('');
      $table->string('Order_AddressUserSend');
      $table->string('Order_Note')->default('');
      $table->json('Order_ListProduct');
      $table->integer('Order_Watched')->default(0);;
      $table->integer('Order_Status')->default(0);;
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
    Schema::dropIfExists('order_essential_oil');
  }
}
