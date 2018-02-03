<?php

namespace Humweb\Blog\Commands;

use Humweb\Blog\Commands\Traits\PersistentCommand;
use Humweb\Blog\Events\PostWasUpdated;
use Humweb\Blog\Models\Post;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

/**
 * CreatePost
 *
 * @package Humweb\Blog\Commands
 */
class UpdatePost
{
    use PersistentCommand, ValidatesRequests;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'title'        => '',
        'slug'         => '',
        'content_html' => '',
    ];

    protected $id;


    /**
     * Construct data
     *
     * @param \Illuminate\Http\Request $data
     * @param                          $id
     */
    public function __construct(Request $data, $id)
    {
        $this->data = $data;
        $this->id   = $id;
    }


    /**
     * Execute the command.
     *
     */
    public function handle()
    {
        $request = $this->data();

        // Massage data
        $data = [
            'title'            => $request->get('title'),
            'description'      => $request->get('description'),
            'content_html'     => $request->get('content_html'),
            'updated_by'       => $this->getUserId(),
            'category_id'      => $request->get('category_id'),
            'status'           => $request->get('status', 1),
            'meta_title'       => $request->get('meta_title'),
            'meta_description' => $request->get('meta_description'),
            'published_at'     => $request->get('published_at'),
        ];

        // Validate
        $this->validate($request, $this->rules);

        // Update post
        $post = Post::find($this->id);
        $post->fill($this->dataWithoutNull($data))->save();

        // Trigger event
        event(new PostWasUpdated($post));

        return $post;
    }

}