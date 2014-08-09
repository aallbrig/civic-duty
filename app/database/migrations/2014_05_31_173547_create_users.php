<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('password')->unique();
			$table->integer('zip');
			$table->integer('points');
			$table->integer('morality');
			$table->integer('reputation');
			$table->text('flavorText');
			$table->string('img');
		});
		Schema::create('activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('points');
			$table->integer('morality');
			$table->string('title');
			$table->text('description');
		});
		Schema::create('users_activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('activity_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade')->onUpdate('cascade');
            // $table->primary(['user_id','activity_id']);  // :(
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
		Schema::drop('users_activities');
		Schema::drop('users');
		Schema::drop('activities');
	}

}
