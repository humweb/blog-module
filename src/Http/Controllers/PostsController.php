<?php

namespace Humweb\Blog\Http\Controllers;

use Humweb\Core\Http\Controllers\AdminController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Humweb\Blog\Commands\CreatePost;
use Humweb\Blog\Commands\DeletePost;
use Humweb\Blog\Commands\UpdatePost;
use Humweb\Blog\Models\Post;

class PostsController extends AdminController
{
    use DispatchesJobs;


    /**
     * Post index post
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $data = [
            'posts'    => Post::orderBy('updated_at', 'desc')->get()
        ];

        return $this->setContent('blog::index', $data);
    }

    /**
     * Single post post
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */

    public function getOne($id)
    {
        $data = [
            'posts' => Post::find($id)
        ];

        return view('content.posts.single', $data);
    }


    /**
     * Create post post
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        $post = new Post;

        return view('content.posts.form', [
            'posts'            => $post,
            'available_tags'  => $post->existingTags()->lists('name', 'name'),
            'selected_tags'   => [],
            'available_posts' => $post->getRelatedAttribute()->lists('name', 'id')->all(),
            'selected_posts'  => [],
            'groups'          => [0 => 'Select group'] + Group::orderBy('position')->lists('name', 'id')->all(),
            'files'           => [],
            'formTypeLabel'   => 'Create'
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

        $post  = Post::find($id);
        $files = $post->getMedia();
        //        dd($files);
        $groups = [0 => 'Select group'] + Group::orderBy('position')->lists('name', 'id')->all();

        // Group files by collections
        foreach ($files as $file) {
            if ( ! isset($organizedFiles[$file->collection_name])) {
                $organizedFiles[$file->collection_name] = [];
            }
            $organizedFiles[$file->collection_name][] = $file;
        }
        $related = $post->getRelatedAttribute();

        return view('content.posts.form', [
            'posts'            => $post,
            'available_tags'  => $post->existingTags()->lists('name', 'name'),
            'selected_tags'   => $post->tags->lists('name', 'name')->all(),
            'available_posts' => $post->getRelatedAttribute()->lists('name', 'id')->all(),
            'selected_posts'  => $related->lists('id')->all(),
            'groups'          => $groups,
            'files'           => $files,
            'organizedFiles'  => $organizedFiles,
            'formTypeLabel'   => 'Update'
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
    public function postUpdate(Request $request, $id)
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
