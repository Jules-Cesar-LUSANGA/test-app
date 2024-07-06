<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->orderBy('role_id')->paginate(5);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // dd($request->validated());
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return back()->with('success', "L'utilisateur a été enregistré avec succès !");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles =  Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Check user email
        if (!$this->checkEmailBelongsToUser($user, $request->email)) {
            return back()->with('success', 'Email déjà utilisé');
        }

        $user->update($request->validated());

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with('success', 'Utilisateur supprimé');
    }

    public function checkEmailBelongsToUser(User $user, string $email)
    {
        $registered = User::where('email', $email)
                            ->first();

        if ($registered == $user) {
            return true;
        } else {
            return false;
        }
    }
}
