<?php namespace Humweb\Blog\Models;

use Humweb\Core\Data\Traits\HasRelatedContent;
use Humweb\Core\Data\Traits\SluggableTrait;
use Humweb\Tags\Models\TaggableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 *
 * @package Humweb\Blog\Models
 */
class Post extends Model
{
    use TaggableTrait, HasRelatedContent, SluggableTrait;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'featured',
        'category_id',
        'created_by',
        'published_at'
    ];

    protected $dates = [
        'published_at'
    ];

    protected $casts = [
        'featured' => 'boolean'
    ];

    protected $statusList = [
        1 => 'Published',
        2 => 'Draft',
        3 => 'Disabled',
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->slugOptions = [
            'maxlen'     => 200,
            'unique'     => true,
            'slug_field' => 'slug',
            'from_field' => 'title',
        ];
    }


    /**
     * Scope a query to only include active posts
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function statusText()
    {
        return $this->statusList[$this->status];
    }

}