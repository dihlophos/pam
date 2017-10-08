<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organ;
use App\Models\Institution;
use App\Models\Subdivision;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('displayname')->paginate(50);
        $organs = Organ::orderBy('name', 'asc')->pluck('name', 'id');
        $institutions = Institution::orderBy('name', 'asc')->pluck('name', 'id');
        $subdivisions = Subdivision::orderBy('name', 'asc')->pluck('name', 'id');
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');
        return view('lists.users.index',
            compact('users', 'organs', 'institutions', 'subdivisions', 'roles')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $request->offsetSet('password', Hash::make($request->password));
        $user = User::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $organs = Organ::orderBy('name', 'asc')->pluck('name', 'id');
        $institutions = Institution::orderBy('name', 'asc')->pluck('name', 'id');
        $subdivisions = Subdivision::orderBy('name', 'asc')->pluck('name', 'id');
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');

        return view('lists.users.edit', compact(
            'user', 'organs', 'institutions', 'subdivisions', 'roles')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, User $user)
    {
        $data = $request->all();
        //unchecked checkboxes are not POSTed
        if (!array_key_exists('is_admin', $data)) $data['is_admin'] = 0;
        $user->fill($data)->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('user.index');
    }
}
