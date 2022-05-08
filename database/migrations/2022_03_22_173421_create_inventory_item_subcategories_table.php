<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_item_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('item_subcat_name');
            $table->longText('item_subcat_des')->nullable();
            $table->unsignedBigInteger('item_cat_id');
            $table->foreign('item_cat_id') ->references('id') ->on('inventory_item_categories');
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
        Schema::dropIfExists('inventory_item_subcategories');
    }
}
