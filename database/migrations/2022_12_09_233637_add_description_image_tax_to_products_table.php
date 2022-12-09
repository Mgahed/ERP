<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionImageTaxToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('description_en')->after('name_ar')->nullable();
            $table->string('description_ar')->after('description_en')->nullable();
            $table->string('image')->after('id')->nullable();
            $table->double('tax', 8, 2)->after('discount_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description_en');
            $table->dropColumn('description_ar');
            $table->dropColumn('image');
            $table->dropColumn('tax');
        });
    }
}
