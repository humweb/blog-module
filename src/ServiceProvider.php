<?php

namespace Humweb\Blog;

use Humweb\Blog\Repositories\PostManager;
use Humweb\Modules\ModuleBaseProvider;

class ServiceProvider extends ModuleBaseProvider
{

    protected $moduleMeta = [
        'name'    => 'Blog',
        'slug'    => 'blog',
        'version' => '0.0.1',
        'author'  => 'Ryan Shofner',
        'email'   => 'ryun@humboldtweb.com',
        'website' => 'humboldtweb.com',
    ];

    protected $permissions = [

        // Users
        'blogs.create' => [
            'name'        => 'Create Posts',
            'description' => 'Create blogs.',
        ],
        'blogs.edit'   => [
            'name'        => 'Edit Posts',
            'description' => 'Edit blogs.',
        ],
        'blogs.list'   => [
            'name'        => 'List Posts',
            'description' => 'List blogs.',
        ],
        'blogs.delete' => [
            'name'        => 'Delete Posts',
            'description' => 'Delete blogs.',
        ],
    ];

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->app['modules']->put('blog', $this);
        $this->loadViews();
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {

    }

    public function getAdminMenu()
    {
        return [
            'Content' => [
                [
                    'label'    => 'Posts',
                    'url'      => route('get.admin.blog.posts'),
                    'icon'     => '<i class="fa fa-book" ></i>',
                    'children' => [
                        ['label' => 'List', 'url' => route('get.admin.blog.posts')],
                        ['label' => 'Create', 'url' => route('get.admin.blog.posts.create')],
                    ],
                ],
            ],
        ];
    }
}
