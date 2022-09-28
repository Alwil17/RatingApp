<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RatingResource::collection(Rating::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RatingRequest $request)
    {
        $rating = Rating::create($request->all());
        return new RatingResource($rating);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rating = Rating::findOrFail($id);
        return new RatingResource($rating);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RatingRequest $request
     * @param  int  $id
     * @return RatingResource
     */
    public function update(RatingRequest $request, $id)
    {
        $rating = Rating::findOrFail($id);
        $rating->update($request->all());
        return new RatingResource($rating);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return response(null, 204);
    }
}
