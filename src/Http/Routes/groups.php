<?php

$this->group(['prefix' => 'help', 'middleware' => ['auth']], function () {

    $this->get('groups/create', [
        'as'   => 'get.help.groups.create',
        'uses' => 'GroupsController@getCreate'
    ]);

    $this->post('groups/create', [
        'as'   => 'post.help.groups.create',
        'uses' => 'GroupsController@postCreate'
    ]);

    $this->get('groups/update/{id}', [
        'as'   => 'get.help.groups.update',
        'uses' => 'GroupsController@getUpdate'
    ]);

    $this->match(['post', 'put'], 'groups/update/{id}', [
        'as'   => 'post.help.groups.update',
        'uses' => 'GroupsController@postUpdate'
    ]);

    $this->any('groups/remove/{id}', [
        'as'   => 'post.help.groups.remove',
        'uses' => 'GroupsController@postRemove'
    ]);

    $this->get('groups', [
        'as'   => 'get.help.groups',
        'uses' => 'GroupsController@getIndex'
    ]);

    $this->get('dashboard', [
        'as'   => 'get.help.dashboard',
        'uses' => 'HomeController@getIndex'
    ]);

    $this->group(['prefix' => 'api'], function () {

        $this->get('groups/{id}', [
            'as'   => 'get.api.groups.single',
            'uses' => 'Api\GroupsController@getOne'
        ]);

        $this->post('groups/sort', [
            'as'   => 'post.api.help.groups.sort',
            'uses' => 'Api\GroupsController@postSort'
        ]);

        $this->match(['post', 'put'], 'groups/{id}', [
            'as'   => 'get.api.groups.single',
            'uses' => 'Api\GroupsController@postUpdate'
        ]);
        $this->get('groups', [
            'as'   => 'get.api.groups',
            'uses' => 'Api\GroupsController@getAll'
        ]);

        $this->post('groups', [
            'as'   => 'post.api.help.groups.add',
            'uses' => 'Api\GroupsController@postCreate'
        ]);

        $this->match(['post', 'put'], 'groups/delete/{id}', [
            'as'   => 'post.api.help.groups.delete',
            'uses' => 'Api\GroupsController@postRemove'
        ]);
    });
});

