<?php

namespace Humweb\Blog\Http\Controllers;

use Humweb\Core\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Humweb\Blog\Models\Group;
use Illuminate\Http\Request;
use Humweb\Blog\Commands\CreateGroup;
use Humweb\Blog\Commands\DeleteGroup;
use Humweb\Blog\Commands\UpdateGroup;

class GroupsController extends Controller
{
    use DispatchesJobs;
    
    /**
     * Index post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data = ['groups' => Group::all()];

        return view('content.groups.index', $data);
    }


    /**
     * Single group post
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOne($id)
    {
        $data = ['group' => Group::find($id)];

        return view('content.groups.single', $data);
    }


    /**
     * Create group post
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate(Request $request)
    {
        return view('content.groups.form', ['group' => null, 'formTypeLabel' => 'Create']);
    }


    /**
     * Create group
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $this->dispatch(new CreateGroup($request));

        return back()->with('success', 'Group created.');
    }


    /**
     * Update group post
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdate(Request $request, $id)
    {
        return view('content.groups.form', ['group' => Group::find($id), 'formTypeLabel' => 'Update']);
    }


    /**
     * Update group
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdate(Request $request, $id)
    {

        $this->dispatch(new UpdateGroup($request, $id));

        return back()->with('success', 'Group updated.');
    }


    /**
     * Remove group
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRemove($id)
    {
        $resp = $this->dispatch(new DeleteGroup($id));

        if ($resp === false) {
            return back()->with('error', 'group not found.');
        }

        return back()->with('success', 'group removed.');
    }

}
