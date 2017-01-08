<?php namespace Humweb\Blog\Controllers;

use Humweb\Core\Http\Controllers\Controller;
use Humweb\Blog\Models\Post;
use Humweb\Blog\Repositories\PostRepository;

class PostController extends Controller
{

    protected $layout = 'layouts.default';


    public function getIndex()
    {
        $this->setTitle('Blog Posts');
        $this->crumb('Home', '/')->crumb('Posts');
        $posts = Post::orderBy('created_at', 'desc')->paginate(25);

        return $this->setContent('blog::index', ['posts' => $posts]);
    }


    /**
     * @return PostRepository
     */
    public function getPost($id)
    {
        $post     = Post::find($id);
        $comments = $post->comments();

        return $this->setContent('blog::show', compact('post', 'comments'));
    }

}
