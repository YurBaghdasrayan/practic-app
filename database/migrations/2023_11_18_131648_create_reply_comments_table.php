<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('reply_comments', function (Blueprint $table) {
			$table->id();
			$table->string('reply');
			$table->string('file');
			$table->bigInteger('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->bigInteger('comment_id')->unsigned()->index();
			$table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('reply_comments');
	}
};
