<?php

namespace App\Contracts\Repositories;

use Illuminate\Http\Request;

interface TrackRepository
{
    /**
     * Create a new track.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \App\Models\Track
     */
    public function create(Request $request);
}
