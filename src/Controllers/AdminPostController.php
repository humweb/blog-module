<?php namespace Humweb\Blog\Controllers;

use Humweb\Blog\Models\Post;
use Humweb\Blog\Repositories\PostRepository;
use Humweb\Blog\Requests\CreatePostRequest;
use Humweb\Blog\Requests\UpdatePostRequest;
use Humweb\Core\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;

class AdminPostController extends AdminController
{

    protected $layout = 'layouts.admin';


    public function getIndex(Request $request)
    {
        $this->setTitle('Blog Posts');
        $this->crumb('Home', '/')->crumb('Posts');
        $posts = Post::orderBy('created_at', 'desc')->paginate(25);

        return $this->setContent('blog::index', ['posts' => $posts]);
    }


    public function getCreate()
    {
        return $this->setContent('blog::forms.posts.create');
    }


    public function postCreate(CreatePostRequest $request, SessionManager $session)
    {
        $post = Post::create($request->except(['_token']));
        $session->flash('success', 'Blog post created, with id: '.$post->id);

        return redirect()->route('get.blog.posts');
    }


    /**
     * Update Post Form
     *
     * @return \Illuminate\View\View
     */
    public function getUpdate($id)
    {
        $post = Post::find($id);

        return $this->setContent('blog::forms.posts.update', ['post' => $post]);
    }


    /**
     * Update Post Store
     *
     * @param CreatePostRequest $request
     * @param SessionManager    $session
     * @param                   $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdate(UpdatePostRequest $request, SessionManager $session, $id)
    {
        Post::where('id', $id)->update($request->except(['_token']));
        $session->flash('success', 'Blog post with id: '.$id.' updated.');

        return redirect()->route('get.blog.posts');
    }


    /**
     * @param \Illuminate\Session\SessionManager $session
     * @param                                    $id
     *
     * @return \Humweb\Blog\Repositories\PostRepository
     */
    public function getDelete(SessionManager $session, $id)
    {
        Post::destroy($id);
        $session->flash('success', 'Blog post with id: '.$id.' deleted.');

        return redirect()->route('get.blog.posts');
    }

}
