<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message_messages', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('to_id')->unsigned();
			$table->foreign('to_id')->references('id')->on('users');
			$table->integer('from_id')->unsigned();
			$table->foreign('from_id')->references('id')->on('users');
			$table->enum('status', array('new', 'read'))->default('new');
			$table->string('title', 128)->nullable();
			$table->text('content');
			$table->softDeletes();
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
		Schema::table('message_messages', function($table) {
			$table->dropForeign('message_messages_to_id_foreign');
			$table->dropForeign('message_messages_from_id_foreign');
		});
		Schema::drop('message_messages');
	}

}
