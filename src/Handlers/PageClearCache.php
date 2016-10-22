<?php

namespace Humweb\Blog\Handlers;

use Illuminate\Contracts\Cache\Repository as CacheContract;

class PostClearCache
{
    protected $cache;

    /**
     * ComponentClearCache constructor.
     *
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(CacheContract $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle()
    {
        $this->cache->forget('dashboard:content:menu');
        $this->cache->forget('dashboard:content:hierarchy');
    }
}
