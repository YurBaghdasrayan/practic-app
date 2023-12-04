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
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->string('comment');
			$table->string('file')->nullable();
			$table->unsignedBigInteger('commentable_id')->unsigned()->index();;
			$table->foreign('commentable_id')->references('id')->on('posts')->onDelete('cascade');
			$table->string('commentable_type');
			$table->bigInteger('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('comments');
	}
};
