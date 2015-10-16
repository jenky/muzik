<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\API\v1\TrackRequest;
use App\Models\Track;
use App\Contracts\Repositories\TrackRepository;

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
        $tracks = apihelper($track->with('tagged', 'media'))->collection();

        $tracks->each(function ($track) {
            $track->prepare();
        });

        return response()->json($tracks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Track $track)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\API\v1\TrackRequest $request
     * @param \App\Contracts\Repositories\TrackRepository $trackRepo
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(TrackRequest $request, TrackRepository $trackRepo)
    {
        $trackRepo->create($request);

        return $this->response->created();
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
        $track = $this->getResource($track->with('tagged', 'media'), $id);
        $track->prepare();

        return response()->json($track);
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
     * @param int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(TrackRequest $request, Track $track, $id)
    {
        $track = $this->getResource($track->with('tagged', 'media'), $id);

        $track->update($request->except('artist_ids', 'artwork', 'tags'));
        $track->artists()->attach($request->input('artist_ids', []));

        if ($request->hasFile('artwork')) {
            $track->clearMediaCollection('artwork');
            $track->addMedia($request->file('artwork'))->toCollection('artwork');
        }

        if ($tags = $request->input('tags')) {
            $track->tag($tags);
        }

        $track->prepare();

        return response()->json($track);
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
