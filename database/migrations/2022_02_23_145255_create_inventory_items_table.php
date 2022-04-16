<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_code');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('inventory_item_categories'); 
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('inventory_item_brands');
            $table->unsignedBigInteger('subcat_id');
            $table->foreign('subcat_id')->references('id')->on('inventory_item_subcategories');
            $table->longText('item_des')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('inventory_items');
    }
}
