<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StructureRequest;
use App\Http\Resources\StructureResource;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StructureResource::collection(Structure::all());
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
    public function store(StructureRequest $request)
    {
        $inputs = $this->getInputs($request);
        $structure = Structure::create($inputs);
        return new StructureResource($structure);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $structure = Structure::findOrFail($id);
        return new StructureResource($structure);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StructureRequest $request, $id)
    {
        $inputs = $this->getInputs($request);
        $structure = Structure::findOrFail($id);
        $structure->update($inputs);
        return new StructureResource($structure);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $structure = Structure::findOrFail($id);
        $structure->delete();
        return response(null, 204);
    }
}
