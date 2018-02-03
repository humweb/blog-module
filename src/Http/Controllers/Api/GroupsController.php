<?php

namespace Humweb\Blog\Http\Controllers\Api;

use Humweb\Blog\Commands\CreateGroup;
use Humweb\Blog\Commands\DeleteGroup;
use Humweb\Blog\Commands\UpdateGroup;
use Humweb\Blog\Http\Traits\ApiResponse;
use Humweb\Blog\Models\Group;
use Humweb\Core\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    use ApiResponse, DispatchesJobs;


    /**
     * @return array
     */
    public function getAll()
    {
        return $this->responseSuccess(['groups' => Group::all()]);
    }


    /**
     * @param $id
     *
     * @return array
     */
    public function getOne($id)
    {
        return $this->responseSuccess(['group' => Group::find($id)]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function postCreate(Request $request)
    {
        $group = $this->dispatch(new CreateGroup($request));

        return $this->responseCreated(['group' => $group], 'group created.');
    }


    /**
     * @param $id
     *
     * @return array
     */
    public function postRemove($id)
    {
        $resp = $this->dispatch(new DeleteGroup($id));

        if ($resp === false) {
            return $this->responseNotFound([], 'group not found.');
        }

        return $this->responseSuccess([], 'group removed.');
    }


    public function postUpdate(Request $request, $id)
    {
        $group = $this->dispatch(new UpdateGroup($request, $id));

        return $this->responseSuccess(['group' => $group], 'group updated.');
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function postSort(Request $request)
    {
        $item = Group::find($request->get('item'));

        $item->position = $request->get('to');
        $item->save();

        $this->dispatch(new UpdateGroup($request, $request->get('item')));

        return $this->responseSuccess([], 'group updated.');
    }

}
