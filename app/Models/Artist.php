<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Artist extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = ['id', '_method', '_token'];

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
        'name'      => 'required|min:2',
        'permalink' => 'required|min:2|alpha_dash|unique:artists',
    ];

    /**
     * @Relation
     * Get all the tracks for current artist.
     */
    public function tracks()
    {
        return $this->belongsToMany(Track::class);
    }

    /**
     * Get the permalink url.
     * 
     * @return string
     */
    public function getPermalinkUrlAttribute()
    {
        return root_domain(url('a/' . str_slug($this->permalink)));
    }
}
