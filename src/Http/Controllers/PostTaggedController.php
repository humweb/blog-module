<?php

namespace Humweb\Blog\Http\Controllers;

use Humweb\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Humweb\Blog\Models\Post;

class PostTaggedController extends BaseContentController
{

    protected $layout = 'content.layouts.default';


    public function __construct()
    {
        parent::__construct();
        $this->loadMenu();
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function getIndex(Request $request, $tag)
    {
        $posts = [];

            $tags = str_contains($tag, ',') ? explode(',', $tag) : [$tag];
            $posts = Post::withAnyTag($tags)->with('group')->get();


        return $this->setContent('content.posts.tagged', ['posts' => $posts, 'tags' => $tags]);
    }
}
