<?php

namespace Humweb\Blog\Http\Controllers;

use Humweb\Blog\Commands\CreatePost;
use Humweb\Blog\Commands\DeletePost;
use Humweb\Blog\Commands\UpdatePost;
use Humweb\Blog\Models\Post;
use Humweb\Blog\Requests\UpdatePostRequest;
use Humweb\Core\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class AdminPostController extends AdminController
{

    /**
     * Post index post
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $data = [
            'posts' => Post::orderBy('updated_at', 'desc')->get()
        ];

        return $this->setContent('blog::index', $data);
    }


    /**
     * Create post post
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        $post = new Post;

        return $this->setContent('blog::forms.posts.create', [
            'posts'          => $post,
            'available_tags' => [],
            //            'available_tags' => Tag::pluck('name', 'name'),
            'selected_tags'  => [],
            //'available_posts' => $post->getRelatedAttribute()->lists('name', 'id')->all(),
            'selected_posts' => [],
            'formTypeLabel'  => 'Create'
        ]);
    }


    /**
     * Create post
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {

        $this->dispatch(new CreatePost($request));

        return back()->with('success', 'post created.');
    }


    /**
     * Update post post
     *
     * @param integer $id
     *
     * @return \Illuminate\View\View
     */
    public function getUpdate($id)
    {
        $organizedFiles = [];

        $post = Post::with('tagged')->find($id);

        //        $related = $post->getRelatedAttribute();

        return $this->setContent('blog::forms.posts.update', [
            'post'           => $post,
            'available_tags' => [],
            //            'available_tags' => Tag::pluck('name', 'name'),
            'selected_tags'  => $post->tagged->pluck('name', 'name')->all(),
            //            'available_posts' => $post->getRelatedAttribute()->lists('name', 'id')->all(),
            //            'selected_posts'  => $related->lists('id')->all(),
            'formTypeLabel'  => 'Update'
        ]);
    }


    /**
     * Update post
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdate(UpdatePostRequest $request, $id)
    {
        $this->dispatch(new UpdatePost($request, $id));

        return back()->with('success', 'post updated.');
    }


    /**
     * Delete post
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRemove(Request $request, $id)
    {
        $resp = $this->dispatch(new DeletePost($request, $id));

        if ($resp === false) {
            return back()->with('error', 'post not found.');
        }

        return back()->with('success', 'post removed.');
    }

}
