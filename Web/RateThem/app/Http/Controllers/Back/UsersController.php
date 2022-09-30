<?php

namespace App\Http\Controllers\Back;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
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
        return view('back.users.form');
    }

    protected function getInputs($request){
        $inputs = $request->validated();
        if($request->has('password')){
            $inputs['password'] = Hash::make($request->password);
        }
        return $inputs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $inputs = $this->getInputs($request);
        User::create($inputs);
//        Http::asForm()->post(url('/api/users'), $request->all());
        return back()->with('alert', config('messages.usercreated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('back.users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $inputs = $this->getInputs($request);
        $user->update($inputs);
        return back()->with('alert', config('messages.userupdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('alert', config('messages.userdeleted'));
    }
    public function alert(User $user)
    {
        return view('back.users.destroy', ['user' => $user]);
    }
}
