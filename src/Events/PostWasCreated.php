<?php

namespace Humweb\Blog\Events;

use Illuminate\Queue\SerializesModels;
use Humweb\Blog\Models\Post;

/**
 * PostWasCreated
 *
 * @package Humweb\Blog\Events
 */
class PostWasCreated
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