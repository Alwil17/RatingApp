<?php

namespace App\Http\Controllers\Back;

use App\DataTables\DaysDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DayRequest;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DaysDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.days.form');
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
        Day::create($inputs);
//        Http::asForm()->post(url('/api/days'), $request->all());
        return back()->with('alert', config('messages.daycreated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Day $day)
    {
        return view('back.days.form', compact('day'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Day $day)
    {
        $inputs = $this->getInputs($request);
        $day->update($inputs);
        return back()->with('alert', config('messages.dayupdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Day $day)
    {
        $day->delete();
        return redirect(route('days.index'));
    }
    public function alert(Day $day)
    {
        return view('back.days.destroy', ['day' => $day]);
    }
}
