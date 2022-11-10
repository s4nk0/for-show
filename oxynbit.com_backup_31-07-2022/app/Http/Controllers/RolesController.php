<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('roles_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all();
        $permissions = Permission::all();

        return view('roles.index', compact('roles','permissions'));
    }

    public function show(Role $role){
        abort_if(Gate::denies('roles_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all();
        return view('roles.show',compact('role','permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role){
        $role->update($request->validated());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('roles_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    public function store(UpdateRoleRequest $request)
    {
        $role = Role::create($request->validated());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index');
    }
}
