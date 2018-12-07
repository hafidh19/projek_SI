<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->string('nbarang'); /**kolom nama barang */
            $table->text('deskripsi');
            $table->integer('hbarang');/**harga barang */
            $table->string('gambar')->nullable()->default(null);
            $table->timestamps();
         
            $table->foreign('admin_id')
            ->references('id')->on('admins')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
