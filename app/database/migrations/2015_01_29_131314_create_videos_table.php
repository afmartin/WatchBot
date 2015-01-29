<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("videos", function($newtable) {
			$newtable->increments('id');
			$newtable->string("title")->unique();
			$newtable->string("video")->unique();
			$newtable->text("description");
			$newtable->integer("views");

			$newtable->integer("user_id")->unsigned();
			$newtable->foreign("user_id")->references("id")->on('users');

			$newtable->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("videos");
	}

}
