<?php

namespace Humweb\Blog\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Humweb\Blog\Commands\CreatePost;
use Humweb\Blog\Commands\DeletePost;
use Humweb\Blog\Commands\UpdatePost;
use Humweb\Blog\Events\PostWasUpdated;
use Humweb\Blog\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends ApiController
{

    /**
     * @return Response
     */
    public function getAll()
    {
        return $this->responseSuccess(['posts' => Post::all()]);
    }


    /**
     * @param $id
     *
     * @return Response
     */
    public function getOne($id)
    {
        return $this->responseSuccess(['post' => Post::find($id)]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function postCreate(Request $request)
    {
        $post = $this->dispatch(new CreatePost($request));

        return $this->responseCreated(['post' => $post], 'post created.');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return Response
     */
    public function postRemove(Request $request, $id)
    {
        $resp = $this->dispatch(new DeletePost($request, $id));

        if ($resp === false) {
            return $this->responseNotFound([], 'post not found.');
        }

        return $this->responseSuccess([], 'post removed.');
    }


    /**
     * Update post
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id)
    {
        $post = $this->dispatch(new UpdatePost($request, $id));

        return $this->responseSuccess(['post' => $post], 'post updated.');
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function postSort(Request $request)
    {
        $action = $request->get('action');
        $item   = Post::find($request->get('item'));
        try {
            if ($action == 'move') {
                $item->group_id = (int)$request->get('to');
                $item->position = (int)$request->get('pos');
                $item->save();
            } elseif ($action == 'sort') {
                $item->position = (int)$request->get('to');
                $item->save();
            } else {
                // handle unknown action
            }
        } catch (\Exception $e) {
            return $this->responseInternalError([], $e->getMessage());
        }

        event(new PostWasUpdated($item));

        return $this->responseSuccess([], 'Updated post');
    }
}
