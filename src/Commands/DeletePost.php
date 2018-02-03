<?php

namespace Humweb\Blog\Commands;

use Humweb\Blog\Commands\Traits\PersistentCommand;
use Humweb\Blog\Events\PostWasDeleted;
use Humweb\Blog\Models\Post;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

/**
 * CreatePost
 *
 * @package Humweb\Blog\Commands
 */
class DeletePost
{
    use PersistentCommand, ValidatesRequests;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'        => 'string',
        'description' => 'string|max:255',
        'status'      => 'int|min:1|max:4',
        'position'    => 'int',
        'group_id'    => 'int'
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

        // Delete post
        $post = Post::find($this->id);

        if (is_null($post)) {
            return false;
        }

        $post->delete();

        // Trigger event
        event(new PostWasDeleted($post));

        return $post;
    }

}