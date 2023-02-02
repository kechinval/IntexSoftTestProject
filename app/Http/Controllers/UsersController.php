<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Organizations;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = Users::with('organizations')->orderBy('id')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $organizations = Organizations::get();
        return view('users.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = new Users($request->validated());
        $user->save();
        $user->organizations()->attach($request->validated('organizations_id'));
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Users $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('users.show', [
            'user' => Users::with('organizations')
                ->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Users $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Users $user)
    {
        $user = Users::with('organizations')->find($user->id);
        $user_orgs = $user
            ->organizations()
            ->pluck('id')
            ->toArray();
        $organizations = Organizations::get();
        return view('users.edit', compact(['user', 'user_orgs', 'organizations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Users $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, Users $user)
    {
        $user->update($request->validated());
        $user->organizations()->sync($request->validated('organizations_id'));
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Users $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Users $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
