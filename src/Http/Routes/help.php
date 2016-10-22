<?php


$this->group(['prefix' => 'blog', 'middleware' => ['auth']], function () {

    $this->get('/', [
        'as'   => 'get.help.index',
        'uses' => 'BrowseController@getIndex'
    ]);

    $this->get('tagged/{tags}', [
        'as'   => 'get.help.tagged.search',
        'uses' => 'PostsTaggedController@getIndex'
    ]);

    $this->get('browse/{post}', [
        'as'   => 'get.help.post',
        'uses' => 'BrowseController@getPost'
    ]);

});
