<?php

namespace Humweb\Blog\Http\Controllers;

use Humweb\Core\Http\Controllers\Controller;
use Humweb\Core\Http\Requests;
use App\Humweb\Blog\Presenters\PostPresenter;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Humweb\Blog\Models\Group;
use Humweb\Blog\Models\Post;
use LGL\Core\Support\Facades\Menu;

class BrowseController extends BaseContentController
{
    use DispatchesJobs;

    protected $layout = 'content.layouts.default';

    public function __construct()
    {
        parent::__construct();
        $this->loadMenu();
    }


    /**
     * Show the application dashboard.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $data['title']       = 'Help Content';
        $data['breadcrumbs'] = $this->breadcrumbs;

        return $this->setContent('content.index', $data);
    }

    public function getPost(Request $request, $postId)
    {
        $whereField = is_numeric($postId) ? 'id' : 'slug';
        $post       = Post::with('group', 'tagged', 'media')->where($whereField, $postId)->first();

        $mediaPresenter = new PostPresenter($post);
        $post->media = $mediaPresenter->present();

        $this->viewShare('posts', $post);

        if ($request->get('single', false)) {
            $this->layout = 'content.layouts.single';
            $this->setupLayout();
        }

        return $this->setContent('content.index', $this->data);
    }
    

}
