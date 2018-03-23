<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon as Carbon;

class Post extends Model {

    use Traits\Uuids;
    use SoftDeletes;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Get the post content as markdown converted to HTML.
     *
     * @param string $value The value accessor passed from the model
     * @return string       Markdown converted to HTML
     */
    public function getContentAttribute($value) {
        return Markdown::convertToHtml($value);
    }

    /**
     * Get the post published at date as a human readable day/time string.
     *
     * @param $value  The value accessor passed from the model
     * @return string Published at date converted to day/time string
     */
    public function getPublishedAtDateAttribute($value) {
        $date = Carbon::parse($value);
        return $date->toDayDateTimeString();
    }

    /**
     * Each post has an associated user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(Blog\User::class);
    }

}
