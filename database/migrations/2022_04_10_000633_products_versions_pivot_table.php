<?php

use App\Models\Product;
use App\Models\Version;
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
        Schema::create('products_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Version::class)->constrained()->onDelete('cascade');

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
