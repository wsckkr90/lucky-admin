<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->with(['roles', 'cities']);

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('id', $request->integer('role'));
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'active',
                $request->input('status') === 'active'
            );
        }

        $users = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.users.index',
            compact('users', 'roles')
        );
    }

    public function create()
    {
        $roles = Role::query()
            ->orderBy('name')
            ->get();

        $cities = City::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.users.create',
            compact('roles', 'cities')
        );
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
            'unique:users,email',
        ],

        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
        ],

        'role_id' => [
            'required',
            'integer',
            'exists:roles,id',
        ],

        'cities' => [
            'nullable',
            'array',
        ],

        'cities.*' => [
            'integer',
            'exists:cities,id',
        ],

        'active' => [
            'nullable',
            'boolean',
        ],
    ]);

    try {

        DB::transaction(function () use (
            $request,
            $validated
        ) {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make(
                    $validated['password']
                ),
                'active' => $request->boolean('active'),
            ]);

            $role = Role::query()
                ->where('id', $validated['role_id'])
                ->where('guard_name', 'web')
                ->firstOrFail();

            $user->syncRoles([
                $role
            ]);

            $user->cities()->sync(
                $validated['cities'] ?? []
            );
        });

    } catch (\Throwable $e) {

        report($e);

        return back()
            ->withInput()
            ->with(
                'error',
                'User could not be created: ' . $e->getMessage()
            );
    }

    return redirect()
        ->route('admin.users.index')
        ->with(
            'success',
            'Staff user created successfully.'
        );
}
    public function show(User $user)
    {
        $user->load([
            'roles.permissions',
            'cities',
        ]);

        return view(
            'admin.users.show',
            compact('user')
        );
    }

    public function edit(User $user)
    {
        $user->load([
            'roles',
            'cities',
        ]);

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        $cities = City::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.users.edit',
            compact(
                'user',
                'roles',
                'cities'
            )
        );
    }

    public function update(
        Request $request,
        User $user
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'role_id' => [
                'required',
                'integer',
                'exists:roles,id',
            ],

            'cities' => [
                'nullable',
                'array',
            ],

            'cities.*' => [
                'integer',
                'exists:cities,id',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],
        ]);

        DB::transaction(function () use (
            $request,
            $validated,
            $user
        ) {
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'active' => $request->boolean('active'),
            ];

            if (!empty($validated['password'])) {
                $userData['password'] =
                    Hash::make(
                        $validated['password']
                    );
            }

            $user->update($userData);

            $role = Role::findOrFail(
                $validated['role_id']
            );

            $user->syncRoles([
                $role
            ]);

            $user->cities()->sync(
                $validated['cities'] ?? []
            );
        });

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Staff user updated successfully.'
            );
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()
                ->with(
                    'error',
                    'You cannot delete your own account.'
                );
        }

        if ($user->hasRole('Super Admin')) {
            return back()
                ->with(
                    'error',
                    'The Super Admin account cannot be deleted here.'
                );
        }

        DB::transaction(function () use ($user) {
            $user->cities()->detach();
            $user->syncRoles([]);
            $user->delete();
        });

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Staff user deleted successfully.'
            );
    }
}