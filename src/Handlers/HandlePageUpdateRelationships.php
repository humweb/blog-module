<?php

namespace Humweb\Blog\Handlers;

use Illuminate\Http\Request;
use Humweb\Blog\Models\Post;

/**
 * HandlePostMediaUploads
 *
 * @package Humweb\Blog\Handlers
 */
class HandlePostUpdateRelationships
{
    protected $request;


    /**
     * HandlePostMediaUploads constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Handle the event.
     *
     */
    public function handle($event)
    {
        // Attach file
        $related = $this->request->get('related');
        if (count($related) && $posts = Post::select('id')->whereIn('id', $related)->get()) {
            $event->post->syncRelated(collect($posts));
        }
        else {
            $event->post->syncRelated([]);
        }
    }
}