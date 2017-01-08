<?php

namespace Humweb\Blog\Http\Controllers;

use Humweb\Core\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use LGL\Core\Auth\Laravel\Facades\Sentinel;
use Humweb\Blog\Models\Post;
use Humweb\Blog\Models\Group;
use Humweb\Core\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use LGL\Core\Support\Facades\Breadcrumbs;

class HomeController extends Controller
{
    use DispatchesJobs;

    /**
     * Show the application dashboard.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        
        $data = Cache::remember('dashboard:content:hierarchy', 160, function () {
            $grouped = Group::with(['posts' => function ($q) { $q->orderBy('position'); }])->orderBy('position')->get()->toArray();
            $ungrouped = Post::ungrouped()->orderBy('position')->get()->toArray();
            return [
                'groupedPosts'   => $grouped,
                'ungroupedPosts' => $ungrouped
            ];
        });

        $this->crumb('Content');

        $data['title'] = 'Help Content';
        $data['breadcrumbs'] = $this->breadcrumbs;

        return view('content.dashboard', $data);
    }
}
