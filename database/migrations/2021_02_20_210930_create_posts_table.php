<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('title');
            $table->string('description');
            $table->unsignedBigInteger('responses_count')->default(0);
            $table->unsignedBigInteger('upvotes_count')->default(0);
            $table->unsignedBigInteger('downvotes_count')->default(0);
            $table->boolean('solved')->default(0);

            $table->foreign('user')->references('username')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
