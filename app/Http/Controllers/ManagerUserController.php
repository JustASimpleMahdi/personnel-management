<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\RoleEnum;
use App\UserShiftEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ManagerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNot('id', auth()->id())->paginate();
        return view('manager.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'national_code' => "required|numeric|unique:users,national_code",
            'phone' => "required|numeric|regex:/^09\d{9}$/|unique:users,phone",
            'address' => 'required',
            'username' => "required|unique:users,username",
            'password' => 'required|min:4',
            'role' => ['required', Rule::enum(RoleEnum::class)],
            'shift' => ['required', Rule::enum(UserShiftEnum::class)],
            'salary' => 'required|integer'
        ]);

        $validated['role_id'] = Role::where('key', RoleEnum::MANAGER)->first()->id;
        unset($validated['role']);

        User::create($validated);

        return redirect()->route('manager.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->getRoles();
        return view('manager.users.create', compact('roles'));
    }

    protected function getRoles()
    {
        return Role::whereNot('key', RoleEnum::MANAGER)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = $this->getRoles();
        return view('manager.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'national_code' => "required|numeric|unique:users,national_code,{$user->id}",
            'phone' => "required|numeric|regex:/^09\d{9}$/|unique:users,phone,{$user->id}",
            'address' => 'required',
            'username' => "required|unique:users,username,{$user->id}",
            'password' => 'nullable|min:4',
            'role' => ['required', Rule::enum(RoleEnum::class)],
            'shift' => ['required', Rule::enum(UserShiftEnum::class)],
            'salary' => 'required|integer'
        ]);


        $validated['role_id'] = Role::where('key', RoleEnum::MANAGER)->first()->id;
        unset($validated['role']);

        if(empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('manager.users.edit', ['user' => $user])
            ->with('update-success', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
