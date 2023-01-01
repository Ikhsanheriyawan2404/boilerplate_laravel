<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\DataTables\UsersDataTable;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index', [
            'roles' => Role::get()
        ]);
    }

    protected function store()
    {
        $itemId = request('item_id');

        DB::transaction(function () use ($itemId) {
            if (!$itemId) {
                request()->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email',
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'role' => 'required',
                ]);

                $user = User::create([
                    'name' => request('name'),
                    'email' => request('email'),
                    'password' => Hash::make(request('password')),
                ]);

                $user->assignRole(request('role'));

            } else {
                request()->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email',
                    'role' => 'required',
                    'password' => ['confirmed'],
                ]);

                $user = User::find($itemId);

                $user->update([
                    'name' => request('name'),
                    'email' => request('email'),
                    'password' => request('password') ? Hash::make(request('password')) : $user->password,
                ]);

                $user->syncRoles(request('role'));
            }
        });

        return response()->json([
            'message' => 'Data berhasil disimpan',
        ], 200);
    }

    public function edit($userId)
    {
        $user = User::with('roles')->find($userId);
        return response()->json($user);
    }
}
