<?php

/**
 * Frontend
 */
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

/**
 * Admin
 */
$this->group(['prefix' => 'admin/blog', 'middleware' => ['auth']], function () {

    Route::get('/', [
        'as'   => 'get.admin.blog.posts',
        'uses' => 'AdminPostController@getIndex'
    ]);

    $this->get('posts/create', [
        'as'   => 'get.admin.blog.posts.create',
        'uses' => 'AdminPostController@getCreate',
    ]);

    $this->post('posts/create', [
        'as'   => 'post.admin.blog.posts.create',
        'uses' => 'AdminPostController@postCreate',
    ]);

    $this->get('posts/update/{id}', [
        'as'   => 'get.admin.blog.posts.update',
        'uses' => 'AdminPostController@getUpdate',
    ]);

    $this->match(['post', 'put'], 'posts/update/{id}', [
        'as'   => 'post.admin.blog.posts.update',
        'uses' => 'AdminPostController@postUpdate',
    ]);

    $this->any('posts/remove/{id}', [
        'as'   => 'post.admin.blog.posts.remove',
        'uses' => 'AdminPostController@postRemove',
    ]);

    // Media management
    $this->any('posts/media/remove/{id}', [
        'as'   => 'post.admin.blog.media.remove',
        'uses' => 'MediaController@postRemove',
    ]);
});

/**
 * API Public
 */
$this->group(['prefix' => 'api/blog'], function () {
    $this->get('posts', [
        'as'   => 'get.api.blog.posts',
        'uses' => 'Api\PostsController@getAll',
    ]);
    $this->get('posts/{id}', [
        'as'   => 'get.api.blog.posts.single',
        'uses' => 'Api\PostsController@getOne',
    ])->where('id', '\d+');
});

/**
 * API Private
 */
$this->group(['prefix' => 'api/blog', 'middleware' => ['auth']], function () {

    $this->match(['post', 'put'], 'posts/{id}', [
        'as'   => 'post.api.blog.posts.update',
        'uses' => 'Api\PostsController@postUpdate',
    ]);

    $this->match(['post', 'put'], 'posts/delete/{id}', [
        'as'   => 'post.api.blog.posts.delete',
        'uses' => 'Api\PostsController@postRemove',
    ]);
    $this->post('posts', [
        'as'   => 'post.api.blog.posts.create',
        'uses' => 'Api\PostsController@postCreate',
    ]);
});
