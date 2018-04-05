<?php

namespace Blog;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

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
     * Dates to parse as carbon objects.
     *
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
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the post content as markdown converted to HTML.
     *
     * @param  string $value
     * @return string        Markdown converted to HTML
     */
    public function getContentAttribute($value)
    {
        try {
            return Markdown::convertToHtml($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    /**
     * Get the post published at date as a human readable day/time string.
     *
     * @return string
     */
    public function getPostDateAttribute()
    {
        return $this->published_at_date->format('F j, Y');
    }

    /**
     * Save the string as a slug.
     *
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Each post has an associated user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieve posts that have a published at date.
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published_at_date', '<', Carbon::now())
            ->orderBy('published_at_date', 'dsc');
    }


}
