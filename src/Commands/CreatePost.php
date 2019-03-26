<?php

namespace Humweb\Blog\Commands;

use Carbon\Carbon;
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
        'title'   => 'required',
        'content' => 'required',
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
            'title'        => $request->get('title', ''),
            'content'      => $request->get('content', ''),
            'category_id'  => $request->get('category_id', 1),
            'created_by'   => $this->getUserId(),
            'status'       => $request->get('status', 1),
            'published_at' => $request->get('published_at', Carbon::now()),
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