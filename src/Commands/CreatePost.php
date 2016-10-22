<?php

namespace Humweb\Blog\Commands;

use Humweb\Blog\Commands\Traits\PersistentCommand;
use Humweb\Blog\Events\PostWasCreated;
use Humweb\Blog\Models\Post;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * CreatePost
 *
 * @package Humweb\Blog\Commands
 */
class CreatePost
{
    use PersistentCommand, ValidatesRequests;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'title'        => 'required',
        //        'slug'         => 'required',
        'content_html' => 'required',
    ];


    /**
     * Execute the command.
     *
     */
    public function handle()
    {
        $request = $this->data();
        // Massage data
        $data = [
            'title'            => $request->get('title', ''),
            'slug'             => $request->get('description', ''),
            'content_html'     => $request->get('content_html', ''),
            'category_id'      => $request->get('category_id', 1),
            'created_by'       => $this->getUserId(),
            'status'           => $request->get('status', 1),
            'meta_title'       => $request->get('meta_title', ''),
            'meta_description' => $request->get('meta_description', ''),
            'published_at'     => $request->get('published_at'),
        ];

        // Validate

        $request->merge($data);
        $this->validate($request, $this->rules);

        // Create post
        $post = Post::create($data);
        // Trigger event
        event(new PostWasCreated($post));

        return $post;
    }

}