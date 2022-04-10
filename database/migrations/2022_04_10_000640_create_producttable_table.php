<?php

use App\Enums\ProductState;
use App\Models\Product;
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
        Schema::create('producttable', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->onDelete('cascade');
            $table->string('product_state')->default(ProductState::ToPrepare->value);
            $table->string('uniqueness');
            $table->float('weight')->nullable();

            $table->morphs('producttable');

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
        Schema::dropIfExists('products_versions');
    }
};
