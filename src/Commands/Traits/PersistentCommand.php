<?php

namespace Humweb\Blog\Commands\Traits;

use Illuminate\Http\Request;

/**
 * CreatePost
 *
 * @package Humweb\Blog\Commands
 */
trait PersistentCommand
{

    /**
     * @var \Illuminate\Http\Request
     */
    protected $data;


    /**
     * Construct data
     *
     * @param \Illuminate\Http\Request $data
     */
    public function __construct(Request $data)
    {
        $this->data = $data;
    }


    /**
     * @return mixed
     */
    protected function getUser()
    {
        return $this->data->user();
    }


    /**
     * @return mixed
     */
    protected function getUserId()
    {
        return $this->data->user()->id;
    }


    /**
     * @return bool
     */
    protected function hasUser()
    {
        return ! is_null($this->data->user());
    }


    /**
     * Get data.
     *
     * @return \Illuminate\Http\Request
     */
    protected function data()
    {
        return $this->data;
    }


    /**
     * Filter the command data.
     *
     * @param null|array $data
     *
     * @return array
     */
    protected function dataWithoutNull($data = null)
    {
        $data = $data ?: $this->data()->all();

        return array_filter($data, function ($val) {
            return $val !== null;
        });
    }

}