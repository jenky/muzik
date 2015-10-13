<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\API\v1\ArtistRequest;
use App\Models\Artist;

class ArtistsController extends ApiController
{
    /**
     * The resource name.
     * 
     * @var string
     */
    protected $resource = 'artist';

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Artist $artist
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Artist $artist)
    {
        return response()->json(apihelper($artist)->collection());
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
     * @param \App\Http\Requests\API\v1\ArtistRequest $request
     * @param \App\Models\Artist $artist
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistRequest $request, Artist $artist)
    {
        $artist = $artist->create($request->all());

        return response()->json($artist);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Artist $artist
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist, $id)
    {
        return $this->findResource($artist, $id);
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
     * @param \App\Http\Requests\API\v1\ArtistRequest $request
     * @param \App\Models\Artist $artist
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistRequest $request, Artist $artist, $id)
    {
        return $this->updateResource($artist, $id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Artist $artist
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist, $id)
    {
        return $this->deleteResource($artist, $id);
    }
}
