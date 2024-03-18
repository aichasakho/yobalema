<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleUserFormRequest;
use App\Models\RoleUser;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = RoleUser::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.form', ['role' => new RoleUser()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleUserFormRequest $request)
    {
        RoleUser::create($request->validated());

        return to_route('admin.role.index')
            -> with('success', 'Role modifié avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleUser $role)
    {
        return view('admin.role.form', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUserFormRequest $request, RoleUser $role)
    {
        $role -> update( $request->validated());
        return to_route('admin.role.index')
            -> with('success', 'Role modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleUser $role)
    {
        $role -> delete();

        return redirect()
            -> back()
            -> with('success', "Suppression effectuer avec succès");
    }
}
