<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DayRequest;
use App\Http\Resources\DayResource;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return DayResource::collection(Day::all());
    }

    protected function getInputs($request){
        $inputs = $request->except(["slug"]);
        $inputs["slug"] = Str::slug($request->nom);
        return $inputs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DayRequest $request)
    {
        $inputs = $this->getInputs($request);
        $product = Day::create($inputs);
        return new DayResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return DayResource
     */
    public function show($id)
    {
        $product = Day::findOrFail($id);
        return new DayResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DayRequest $request, $id)
    {
        $inputs = $this->getInputs($request);
        $product = Day::findOrFail($id);
        $product->update($inputs);
        return new DayResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Day::findOrFail($id);
        $product->delete();
        return response(null, 204);
    }
}
