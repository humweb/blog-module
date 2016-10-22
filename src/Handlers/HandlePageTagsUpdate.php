<?php

namespace Humweb\Blog\Handlers;

use Illuminate\Http\Request;

/**
 * HandlePostMediaUploads
 *
 * @package Humweb\Blog\Handlers
 */
class HandlePostTagsUpdate
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
        $tags = $this->request->get('tags');

        if (count($tags)) {
            $event->post->retag($tags);
        }
    }
}