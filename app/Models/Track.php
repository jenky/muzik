<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Track extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id', '_method', '_token', 'artist_ids'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $hidden = ['updated_at', 'deleted_at', 'pivot'];

    /**
     * @var array
     */
    protected $appends = ['permalink_url'];

    /**
     * Validaction rules.
     * 
     * @var array
     */
    public static $rules = [
        'title'      => 'required|min:2',
        'permalink'  => 'required|min:2|alpha_dash|unique:tracks',
        'user_id'    => 'integer',
        'artist_ids' => 'required|array',
    ];

    /**
     * @Relation
     * Get the user for the current track.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @Relation
     * Get all the artists for the current track.
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    /**
     * @Relation
     * Get the artwork.
     */
    public function artwork()
    {
        return $this->morphMany(Media::class, 'model');
    }

    /**
     * Get the permalink url.
     * 
     * @return string
     */
    public function getPermalinkUrlAttribute()
    {
        return root_domain(url('t/'.str_slug($this->permalink)));
    }
}
