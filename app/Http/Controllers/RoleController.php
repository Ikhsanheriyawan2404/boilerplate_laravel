<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDatatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','show']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(RolesDatatable $dataTable)
    {
        return $dataTable->render('roles.index', [
            'permissions' => Permission::get()
        ]);
    }

    public function create()
    {
        return view('roles.create', [
            'permissions' => Permission::get(),
        ]);
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::get(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => request('name')]);
        $role->syncPermissions(request('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil ditambahkan');
    }

    public function update(Role $role)
    {
        request()->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permission' => 'required',
        ]);

        $role->update(['name' => request('name')]);
        $role->syncPermissions(request('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil diedit');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil dihapus');
    }
}
