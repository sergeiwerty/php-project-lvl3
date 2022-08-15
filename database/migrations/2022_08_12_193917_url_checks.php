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
//    public function up('url_checks', function (Blueprint $table)
//    {
//        $table->id();
//        $table->integer('url_id');
//        $table->integer('status_code');
//        $table->text('h1');
//        $table->text('title');
//        $table->text('description');
//        $table->timestamp('created_at');
//    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('url_checks');
    }
};
