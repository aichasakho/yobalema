<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientFormRequest;


class ClientController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = User::with('role_user')
            ->where('role_user_id', '=',2 )
            -> paginate(25);
        return view('admin.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.form', [
            'client' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientFormRequest $request)
    {
        $validate = $request->validated();
        $validate['role_user_id'] = 2;

        User::create($validate);
        return to_route('index')
            -> with('success', 'Client modifié avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $client)
    {
        return view('admin.user.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $client)
    {
        return view('client.form', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientFormRequest $request, User $client)
    {
        $client->update($request->validated());

        return to_route('index')
            ->with('success', 'Client modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $client)
    {
        $client->delete();

        return redirect() -> back()
            -> with('success', "Client supprimer avec succès");
    }
}
