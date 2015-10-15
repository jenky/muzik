<?php

namespace App\Repositories;

use App\Contracts\Repositories\TrackRepository as Contract;
use App\Models\Track;
use Illuminate\Http\Request;

class TrackRepository implements Contract
{
    protected $track;

    /**
     * Class constructor.
     * 
     * @param \App\Models\Track $track
     * 
     * @return void
     */
    public function __construct(Track $track)
    {
        $this->track = $track;
    }

    /**
     * Create a new user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \App\Models\Track
     */
    public function create(Request $request)
    {
        $track = $this->track->create($request->only('title', 'permalink', 'user_id'));

        $track->artists()->attach($request->input('artist_ids', []));

        if ($request->hasFile('artwork')) {
            $track->clearMediaCollection('artwork');
            $track->addMedia($request->file('artwork'))->toCollection('artwork');
        }

        if ($tags = $request->input('tags')) {
            $track->tag($tags);
        }

        return $track;
    }
}
