<?php

namespace App\Models;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Track extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes, Taggable;

    /**
     * @var array
     */
    protected $guarded = ['id', '_method', '_token', 'artist_ids', 'tags'];

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
        'tags'       => 'array',
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
     * Get the permalink url.
     * 
     * @return string
     */
    public function getPermalinkUrlAttribute()
    {
        return root_domain(url('t/'.str_slug($this->permalink)));
    }

    /**
     * Prepare for JSON response.
     * 
     * @return void
     */
    public function prepare()
    {
        $this->addHidden('tagged', 'media');

        $this->tag_list = $this->tagNames();
        $this->artwork_url = $this->getArtwork();
    }

    /**
     * Get the artwork url.
     */
    public function getArtwork()
    {
        $artwork = $this->getMedia('artwork')->first();
    
        if (!is_null($artwork)) {
            $artworkUrl = route('imagecache', ['medium', '1/AdminCP.png']);
        } else {
            $artworkUrl = route('imagecache', ['medium', 'no_image.png']);
        }

        return $artworkUrl;
    }
}
