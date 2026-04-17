<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Papar senarai peranan.
     */
    public function index(): View
    {
        abort_if(! auth()->user()->hasPermission('peranan.view'), 403);

        $roles = Role::withCount(['users', 'permissions'])
            ->latest()
            ->paginate(10);

        return view('pages.admin.peranan.index', compact('roles'));
    }

    /**
     * Papar borang cipta peranan baru.
     */
    public function create(): View
    {
        abort_if(! auth()->user()->hasPermission('peranan.create'), 403);

        $permissions = Permission::orderBy('group')->orderBy('display_name')->get();
        $permissionGroups = $permissions->groupBy('group');

        return view('pages.admin.peranan.create', compact('permissions', 'permissionGroups'));
    }

    /**
     * Simpan peranan baru.
     */
    public function store(Request $request): RedirectResponse
    {
        abort_if(! auth()->user()->hasPermission('peranan.create'), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:roles,name', 'regex:/^[a-z_]+$/'],
            'display_name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
            'is_default' => ['boolean'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ], [
            'name.required' => 'Kod peranan diperlukan.',
            'name.unique' => 'Kod peranan telah digunakan.',
            'name.regex' => 'Kod peranan hanya boleh mengandungi huruf kecil dan garis bawah.',
            'display_name.required' => 'Nama peranan diperlukan.',
            'permissions.*.exists' => 'Kebenaran yang dipilih tidak sah.',
        ]);

        // If setting as default, unset other defaults
        if ($request->boolean('is_default')) {
            Role::where('is_default', true)->update(['is_default' => false]);
        }

        $role = Role::create([
            'name' => $validated['name'],
            'display_name' => $validated['display_name'],
            'description' => $validated['description'] ?? null,
            'is_default' => $request->boolean('is_default'),
        ]);

        // Sync permissions
        if (isset($validated['permissions'])) {
            $role->permissions()->sync($validated['permissions']);
        }

        return redirect()
            ->route('admin.peranan.index')
            ->with('success', 'Peranan baru berjaya dicipta.');
    }

    /**
     * Papar maklumat peranan.
     */
    public function show(Role $peranan): View
    {
        $peranan->load(['permissions', 'users']);

        return view('pages.admin.peranan.show', compact('peranan'));
    }

    /**
     * Papar borang kemaskini peranan.
     */
    public function edit(Role $peranan): View
    {
        abort_if(! auth()->user()->hasPermission('peranan.edit'), 403);

        $permissions = Permission::orderBy('group')->orderBy('display_name')->get();
        $role = $peranan->loadCount('users');

        return view('pages.admin.peranan.edit', compact('role', 'permissions'));
    }

    /**
     * Kemaskini peranan.
     */
    public function update(Request $request, Role $peranan): RedirectResponse
    {
        abort_if(! auth()->user()->hasPermission('peranan.edit'), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', Rule::unique('roles')->ignore($peranan->id), 'regex:/^[a-z_]+$/'],
            'display_name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
            'is_default' => ['boolean'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ], [
            'name.required' => 'Kod peranan diperlukan.',
            'name.unique' => 'Kod peranan telah digunakan.',
            'name.regex' => 'Kod peranan hanya boleh mengandungi huruf kecil dan garis bawah.',
            'display_name.required' => 'Nama peranan diperlukan.',
            'permissions.*.exists' => 'Kebenaran yang dipilih tidak sah.',
        ]);

        // If setting as default, unset other defaults
        if ($request->boolean('is_default')) {
            Role::where('is_default', true)->where('id', '!=', $peranan->id)->update(['is_default' => false]);
        }

        $peranan->update([
            'name' => $validated['name'],
            'display_name' => $validated['display_name'],
            'description' => $validated['description'] ?? null,
            'is_default' => $request->boolean('is_default'),
        ]);

        // Sync permissions
        $peranan->permissions()->sync($validated['permissions'] ?? []);

        return redirect()
            ->route('admin.peranan.index')
            ->with('success', 'Peranan berjaya dikemaskini.');
    }

    /**
     * Padam peranan.
     */
    public function destroy(Role $peranan): RedirectResponse
    {
        abort_if(! auth()->user()->hasPermission('peranan.delete'), 403);

        // Check if any users are assigned to this role
        if ($peranan->users()->exists()) {
            return redirect()
                ->route('admin.peranan.index')
                ->with('error', 'Peranan tidak boleh dipadam kerana masih digunakan oleh pengguna.');
        }

        $peranan->delete();

        return redirect()
            ->route('admin.peranan.index')
            ->with('success', 'Peranan berjaya dipadam.');
    }
}
