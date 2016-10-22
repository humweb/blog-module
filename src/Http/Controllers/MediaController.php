<?php

namespace Humweb\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Humweb\Blog\Commands\DeletePost;
use Humweb\Blog\Commands\DeletePostMedia;
use Humweb\Blog\Commands\UpdatePost;

class MediaController extends Controller
{
    use DispatchesJobs;


    /**
     * Update post post
     *
     * @param \Illuminate\Http\Request $request
     * @param integer                  $postId
     *
     */
    public function postRemove(Request $request, $postId)
    {
        $resp = $this->dispatch(new DeletePostMedia($request, $postId));

        if ($resp === false) {
            return back()->with('error', 'Media not removed.');
        }

        return back()->with('success', 'Media items removed.');
    }

}
