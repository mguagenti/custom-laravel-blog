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
        'user_id',
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
     * @var array
     */
    protected $dates = [
        'published_at_date'
    ];

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey() {
        return 'slug';
    }

    /**
     * Get the post content as markdown converted to HTML.
     *
     * @param  string $value
     * @return string        Markdown converted to HTML
     */
    public function getContentAttribute($value) {
        try {
            return Markdown::convertToHtml($value);
        } catch(\Exception $e) {
            return $value;
        }
    }

    /**
     * Get the post published at date as a human readable day/time string.
     *
     * @param  $value
     * @return string
     */
    public function getPostDateAttribute($value) {
        $date = Carbon::parse($value);
        return $date->toDayDateTimeString();
    }

    /**
     * Save the string as a slug.
     *
     * @param $value
     */
    public function setSlugAttribute($value) {
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Returns the post UUID if slug is empty.
     *
     * @param $value
     * @return mixed
     */
    public function getSlugAttribute($value) {
        if (empty($value)) {
            return $this->id;
        }
        return $value;
    }

    /**
     * Each post has an associated user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieve posts that have a published at date.
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query) {
        return $query->where('published_at_date', '<', Carbon::now())
                     ->orderBy('published_at_date', 'dsc');
    }

}
