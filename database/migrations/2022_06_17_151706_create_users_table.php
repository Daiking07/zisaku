<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('tel');
            $table->string('password');
            $table->unsignedBigInteger('school_id');
            $table->tinyInteger('role')->default(0);
            $table->timestamps();
            $table->dropForeign(['school_id']);
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_school_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('users');
    }
}
