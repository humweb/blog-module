<?php

namespace Humweb\Blog\Events;

use Humweb\Blog\Models\Post;
use Illuminate\Queue\SerializesModels;

class PostWasDeleted
{
    use SerializesModels;

    public $post;

    /**
     * Create a new event instance.
     *
     * @param  Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}