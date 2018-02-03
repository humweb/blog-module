<?php

namespace Humweb\Blog\Http\Controllers\Api;

use Humweb\Blog\Http\Traits\ApiResponse;
use Humweb\Blog\Models\Group;
use Humweb\Blog\Models\Post;
use Humweb\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use ApiResponse;


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function getGroups(Request $request)
    {
        $groups = [];

        if ( ! empty($request->get('search'))) {
            $groups = Group::select('id', 'name', 'description')->where('name', 'ilike', '%'.$request->get('search').'%')->get();
        }

        return $this->responseSuccess(['groups' => $groups]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function getPosts(Request $request)
    {
        $posts = [];

        if ( ! empty($request->get('search'))) {
            $posts = Post::select('id', 'name', 'description')->where('name', 'ilike', '%'.$request->get('search').'%')->get();
        }

        return $this->responseSuccess(['posts' => $posts]);
    }
}
