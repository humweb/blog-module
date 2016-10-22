<?php

namespace Humweb\Blog\Contracts\Repositories;

use Humweb\Core\Contracts\Data\CrudRepositoryInterface;
use Humweb\Core\Contracts\Data\ModelRepositoryInterface;

/**
 * Interface PostRepositoryContract
 *
 * @package Humweb\Blog\Contracts\Repositories
 */
interface PostRepositoryContract extends ModelRepositoryInterface, CrudRepositoryInterface
{

}