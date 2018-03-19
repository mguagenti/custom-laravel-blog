<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    use Traits\Uuids;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'meta',
        'content',
        'published_at_date'
    ];

}
