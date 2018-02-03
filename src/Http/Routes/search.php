<?php

$this->group(['prefix' => 'api/help/search', 'middleware' => ['auth']], function () {

    $this->get('groups', [
        'as'   => 'get.api.search.groups',
        'uses' => 'Api\SearchController@getGroups'
    ]);
    $this->get('posts', [
        'as'   => 'get.api.search.posts',
        'uses' => 'Api\SearchController@getPosts'
    ]);
});
