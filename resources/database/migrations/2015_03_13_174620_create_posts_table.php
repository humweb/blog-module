<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_posts', function ($table)
		{
			$table->increments('id');
			$table->string('title', 150);
			$table->string('slug', 150)->unique();
			$table->integer('category_id')->default(0);
			$table->longText('content')->nullable();
			$table->boolean('featured')->default(false);
			$table->char('status')->default(1);
			$table->integer('created_by')->default(0);
			$table->timestamps();
			$table->timestamp('published_at')->nullable();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('blog_posts');
	}

}
