<?php
$this->group(['prefix' => 'blog'], function () {
    $this->get('/', [
        'as'   => 'get.blog.posts',
        'uses' => 'PostsController@getIndex',
    ]);

    $this->get('post/{id}', [
        'as'   => 'get.blog.posts.single',
        'uses' => 'PostsController@getOne',
    ]);
});

Route::get('posts', [
    'as'   => 'get.admin.blog.posts',
    'uses' => 'PostsController@getIndex'
]);

Route::get('posts/show/{id}', [
    'as'   => 'get.blog.posts.single',
    'uses' => 'PostsController@getPost'
]);

Route::get('posts/create', [
    'as'   => 'get.admin.blog.posts.create',
    'uses' => 'AdminPostController@getCreate'
]);

Route::post('posts/create', [
    'as'   => 'post.admin.blog.posts.create',
    'uses' => 'AdminPostController@postCreate'
]);

// Post : Update
Route::get('posts/update/{id}', [
    'as'   => 'get.admin.blog.posts.update',
    'uses' => 'PostsController@getUpdate'
]);
Route::post('posts/update/{id}', [
    'as'   => 'post.admin.blog.posts.update',
    'uses' => 'AdminPostController@postUpdate'
]);

//Delete
Route::any('posts/delete/{id}', [
    'as'   => 'get.admin.blog.posts.delete',
    'uses' => 'AdminPostController@getDelete'
]);