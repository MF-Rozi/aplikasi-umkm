<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueToSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->unique('slug');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->unique('slug');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropIndex('slug');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('slug');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('slug');
        });
    }
}
