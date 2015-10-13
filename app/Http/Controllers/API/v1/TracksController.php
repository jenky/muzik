<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\API\v1\TrackRequest;
use App\Models\Track;

class TracksController extends ApiController
{
    /**
     * The resource name.
     * 
     * @var string
     */
    protected $resource = 'track';

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Track $track
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Track $track)
    {
        return response()->json(apihelper($track)->collection());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\v1\TrackRequest $request
     * @param \App\Models\Track $track
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(TrackRequest $request, Track $track)
    {
        $track = $track->create($request->all());

        return response()->json($track);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Track $track
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track, $id)
    {
        return $this->findResource($track, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\API\v1\TrackRequest $request
     * @param \App\Models\Track $track
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(TrackRequest $request, Track $track, $id)
    {
        return $this->updateResource($user, $id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Track $track
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track, $id)
    {
        return $this->deleteResource($track, $id);
    }
}
