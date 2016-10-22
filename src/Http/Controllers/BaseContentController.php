<?php

namespace Humweb\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Humweb\Blog\Models\Group;
use Humweb\Blog\Models\Post;
use LGL\Core\Support\Facades\Menu;

class BaseContentController extends Controller
{
    use DispatchesJobs;

    protected $layout = 'content.layouts.default';


    public function __construct()
    {
        parent::__construct();
    }



    protected function loadMenu()
    {
        $this->data = Cache::remember('dashboard:content:menu', 160, function () {

            $grouped = Group::with([
                'posts' => function ($query) {
                    $query->enabled()->orderBy('position');
                }
            ])->orderBy('position')->get()->toArray();

            $ungrouped = Post::ungrouped()->enabled()->orderBy('position')->get()->toArray();

            $menu = [];
            foreach ($grouped as $group) {
                if (count($group['posts']) > 0) {
                    $menu[$group['id']] = [
                        'label'    => $group['name'],
                        'children' => []
                    ];

                    foreach ($group['posts'] as $post) {
                        $menu[$group['id']]['children'][] = [
                            'label' => $post['name'],
                            'url'   => route('get.help.post', ! empty($post['slug']) ? $post['slug'] : $post['id'])
                        ];
                    }
                }
            }
            if (count($ungrouped)) {
                $menu[0] = [
                    'label'    => 'Ungrouped',
                    'children' => []
                ];

                foreach ($ungrouped as $post) {
                    $menu[0]['children'][] = [
                        'label' => $post['name'],
                        'url'   => route('get.help.post', ! empty($post['slug']) ? $post['slug'] : $post['id'])
                    ];
                }
            }

            return [
                'menu'           => $menu,
                'groupedPosts'   => $grouped,
                'ungroupedPosts' => $ungrouped
            ];
        });

        // Add menu
        if (isset($this->data['menu'])) {
            Menu::put('help_nav', $this->data['menu']);
        }
    }
}
