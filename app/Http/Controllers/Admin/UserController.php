<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\RoleUser;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role_user')
            ->paginate(15);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.user.form', [
            'user' => new User(),
            'roles' => $this->setRoleArray(),
        ]);
    }

    private function setRoleArray()
    {
        $donnees = RoleUser::all();
        $roles = array();
        foreach ($donnees as $donnee) {
            $roles[$donnee->name] = $donnee->id;
        }

        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request)
    {
        User::create($request->validated());

        return to_route('admin.user.index')
            ->with('success', 'Utilisateur modifié avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = $this->setRoleArray();
        return view('admin.user.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $user)
    {
        $user->update($request->validated());

        return to_route('admin.user.index')
            ->with('success', 'Utilisateur modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()
            ->with('success', "Utilisateur supprimer avec succès");
    }
}
