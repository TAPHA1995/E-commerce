<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->string('subtitle');
            $table->string('description');
            $table->string('regular_price');
            $table->string('sale_price')->nullable();
            $table->string('SKU');
            $table->enum('stock_status',["instock","outofstock"]);
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('quantity')->default(1);
            $table->string('image');
            $table->text('images');
            // $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('brand_id');
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Category::class, 'category_id')->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Brand::class, 'brand_id')->onDelete('cascade');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
