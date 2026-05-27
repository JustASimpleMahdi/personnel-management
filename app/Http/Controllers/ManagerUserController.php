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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNot('key', RoleEnum::MANAGER)->get();
        return view('manager.users.create', compact('roles'));
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
