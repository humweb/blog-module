<?php namespace Humweb\Blog\Fakes\Repositories;

use Humweb\Blog\Contracts\Repositories\PostRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

/**
 * PostRepository
 * 
 * @package Humweb\Blog\Fakes\Repositories
 */
class PostRepository implements PostRepositoryContract {

    public $dataset = [
        1 => [
            'id' => 1,
            'title' => 'First Post',
            'content_html' => 'First post body'
        ],
        2 => [
            'id' => 2,
            'title' => 'Second Post',
            'content_html' => 'Second post body'
        ],
        3 => [
            'id' => 3,
            'title' => 'Third Post',
            'content_html' => 'Third post body'
        ],
    ];

    public function all()
    {
        return new Collection($this->convertToObjects());
    }

    public function find($id)
    {
        $post = null;
        foreach($this->dataset as $data)
        {

            if ($data['id'] == $id)
            {
                $post = (object)$data;
                break;
            }
        }

        return $post;
    }

   public function create($data = [])
    {
        $data['id'] = 33;
        return (object)$data;
    }

   public function update($id, $data = [])
    {
        return 1;
    }

   public function delete($id)
    {
        return 1;
    }

    protected function convertToObjects()
    {
        $newDataObjects = [];

        foreach($this->dataset as $data)
        {
            $newDataObjects[] = (object)$data;
        }

        return $newDataObjects;
    }
}