<?php

namespace intothesource\users\Http\Controllers;

use App\Role;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return '<h1>inportant!</h1> Add: "packages/Source/Users/src/Models" to "classmap" and "packages/Source/Users/src/Http/Requests" in the composer.json file in your main folder!<br>Without this the model connection would not work.<br>Do not forget to execute the composer command: "composer dump-autoload" and remove this line from the controller.';
        $roles = Role::all();
        return view('UMViews::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('UMViews::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RolesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $role = new Role;
        $role->create($request->only($role->getFillable()));
        return redirect()->route('role.manager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('UMViews::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  RolesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->only($role->getFillable()));
        return redirect()->route('role.manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role.manager.index');
    }
}
