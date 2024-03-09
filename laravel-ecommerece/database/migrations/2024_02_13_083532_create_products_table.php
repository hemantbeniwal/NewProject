<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('status');
            $table->boolean('is_featured')->default(false);
            $table->string('sku');
            $table->integer('qty');
            $table->string('stock_status');
            $table->decimal('weight', 8, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('special_price', 10, 2)->nullable();
            $table->timestamp('special_price_from')->nullable();
            $table->timestamp('special_price_to')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('related_product')->nullable();
            $table->string('url_key')->nullable();
            $table->string('meta_tag')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('products');
    }
};
