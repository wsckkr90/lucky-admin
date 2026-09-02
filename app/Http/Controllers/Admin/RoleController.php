<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()
            ->withCount('users')
            ->with('permissions')
            ->orderBy('name')
            ->paginate(20);

        return view(
            'admin.roles.index',
            compact('roles')
        );
    }

    public function create()
    {
        $permissions = Permission::query()
            ->orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });

        return view(
            'admin.roles.create',
            compact('permissions')
        );
    }

   public function store(
    Request $request
) {
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'unique:roles,name',
        ],

        'permissions' => [
            'nullable',
            'array',
        ],

        'permissions.*' => [
            'integer',
            'exists:permissions,id',
        ],
    ]);

    $role = DB::transaction(
        function () use (
            $validated
        ) {

            $role = Role::create([
                'name' =>
                    $validated['name'],

                'guard_name' =>
                    'web',
            ]);

            $permissionIds =
                $validated['permissions'] ?? [];

            $permissions =
                Permission::query()
                    ->whereIn(
                        'id',
                        $permissionIds
                    )
                    ->where(
                        'guard_name',
                        'web'
                    )
                    ->get();

            $role->syncPermissions(
                $permissions
            );

            return $role;
        }
    );

    return redirect()
        ->route(
            'admin.roles.index'
        )
        ->with(
            'success',
            'Role created successfully.'
        );
}
    public function show(Role $role)
    {
        $role->load('permissions');

        return view(
            'admin.roles.show',
            compact('role')
        );
    }

    public function edit(Role $role)
    {
        $permissions = Permission::query()
            ->orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });

        $role->load('permissions');

        return view(
            'admin.roles.edit',
            compact(
                'role',
                'permissions'
            )
        );
    }

   public function update(
    Request $request,
    Role $role
) {
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'unique:roles,name,' . $role->id,
        ],

        'permissions' => [
            'nullable',
            'array',
        ],

        'permissions.*' => [
            'integer',
            'exists:permissions,id',
        ],
    ]);

    $permissionIds =
        $validated['permissions'] ?? [];

    DB::transaction(function () use (
        $role,
        $validated,
        $permissionIds
    ) {

        /*
        |--------------------------------------------------------------------------
        | Update role name.
        |--------------------------------------------------------------------------
        */

        $role->update([
            'name' =>
                $validated['name'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Convert permission IDs into Permission models.
        |--------------------------------------------------------------------------
        */

        $permissions =
            Permission::query()
                ->whereIn(
                    'id',
                    $permissionIds
                )
                ->where(
                    'guard_name',
                    $role->guard_name
                )
                ->get();

        /*
        |--------------------------------------------------------------------------
        | Give Spatie actual Permission models.
        |--------------------------------------------------------------------------
        */

        $role->syncPermissions(
            $permissions
        );
    });

    return redirect()
        ->route(
            'admin.roles.index'
        )
        ->with(
            'success',
            'Role updated successfully.'
        );
}

    public function destroy(Role $role)
    {
        if ($role->name === 'Super Admin') {
            return redirect()
                ->route('admin.roles.index')
                ->with(
                    'error',
                    'The Super Admin role cannot be deleted.'
                );
        }

        if ($role->users()->exists()) {
            return redirect()
                ->route('admin.roles.index')
                ->with(
                    'error',
                    'This role is assigned to users. Remove the role from those users first.'
                );
        }

        DB::transaction(function () use ($role) {
            $role->syncPermissions([]);
            $role->delete();
        });

        return redirect()
            ->route('admin.roles.index')
            ->with(
                'success',
                'Role deleted successfully.'
            );
    }
}
