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
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'content_html',
        'status',
        'category_id',
        'created_by',
        'meta_title',
        'meta_description',
        'published_at'
    ];

    protected $statusList = [
        1 => 'Enabled',
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
        return $query->where('active', 1);
    }


    public function statusText()
    {
        return $this->statusList[$this->status];
    }

}