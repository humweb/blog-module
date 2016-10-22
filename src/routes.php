<?php


Route::get('posts', [
    'as' => 'get.blog.posts',
    'uses' => 'PostController@getIndex'
]);

Route::get('posts/show/{id}', [
    'as' => 'get.blog.posts.single',
    'uses' => 'PostController@getPost'
]);

Route::get('posts/create', [
    'as' => 'get.blog.posts.create',
    'uses' => 'AdminPostController@getCreate'
]);

Route::post('posts/create', [
    'as' => 'post.blog.posts.create',
    'uses' => 'AdminPostController@postCreate'
]);

// Post : Update
Route::get('posts/update/{id}', [
    'as' => 'get.blog.posts.update',
    'uses' => 'PostController@getUpdate'
]);
Route::post('posts/update/{id}', [
    'as' => 'post.blog.posts.update',
    'uses' => 'AdminPostController@postUpdate'
]);

//Delete
Route::get('posts/delete/{id}', [
    'as' => 'get.blog.posts.delete',
    'uses' => 'AdminPostController@getDelete'
]);