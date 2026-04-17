<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Pengguna permissions
            ['name' => 'pengguna.view', 'display_name' => 'Lihat Senarai Pengguna', 'description' => 'Boleh melihat senarai pengguna', 'group' => 'pengguna'],
            ['name' => 'pengguna.create', 'display_name' => 'Tambah Pengguna', 'description' => 'Boleh menambah pengguna baharu', 'group' => 'pengguna'],
            ['name' => 'pengguna.edit', 'display_name' => 'Edit Pengguna', 'description' => 'Boleh mengedit maklumat pengguna', 'group' => 'pengguna'],
            ['name' => 'pengguna.delete', 'display_name' => 'Padam Pengguna', 'description' => 'Boleh memadam pengguna', 'group' => 'pengguna'],
            ['name' => 'pengguna.manage.admin', 'display_name' => 'Urus Pengguna Admin', 'description' => 'Boleh mengedit/memadam pengguna tahap admin', 'group' => 'pengguna'],

            // Permohonan permissions
            ['name' => 'permohonan.view', 'display_name' => 'Lihat Senarai Permohonan', 'description' => 'Boleh melihat senarai permohonan pendaftaran', 'group' => 'permohonan'],
            ['name' => 'permohonan.approve', 'display_name' => 'Luluskan Permohonan', 'description' => 'Boleh meluluskan permohonan pendaftaran', 'group' => 'permohonan'],
            ['name' => 'permohonan.reject', 'display_name' => 'Tolak Permohonan', 'description' => 'Boleh menolak permohonan pendaftaran', 'group' => 'permohonan'],

            // Peranan permissions
            ['name' => 'peranan.view', 'display_name' => 'Lihat Senarai Peranan', 'description' => 'Boleh melihat senarai peranan', 'group' => 'peranan'],
            ['name' => 'peranan.create', 'display_name' => 'Tambah Peranan', 'description' => 'Boleh menambah peranan baharu', 'group' => 'peranan'],
            ['name' => 'peranan.edit', 'display_name' => 'Edit Peranan', 'description' => 'Boleh mengedit maklumat peranan', 'group' => 'peranan'],
            ['name' => 'peranan.delete', 'display_name' => 'Padam Peranan', 'description' => 'Boleh memadam peranan', 'group' => 'peranan'],
        ];

        foreach ($permissions as $permissionData) {
            Permission::firstOrCreate(
                ['name' => $permissionData['name']],
                $permissionData
            );
        }

        // Create roles
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'superadmin'],
            [
                'display_name' => 'Super Admin',
                'description' => 'Pentadbir utama dengan akses penuh ke semua fungsi',
                'is_default' => false,
            ]
        );

        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'display_name' => 'Admin',
                'description' => 'Pentadbir sistem dengan akses terhad',
                'is_default' => false,
            ]
        );

        $penggunaRole = Role::firstOrCreate(
            ['name' => 'pengguna'],
            [
                'display_name' => 'Pengguna',
                'description' => 'Pengguna biasa dengan akses terhad',
                'is_default' => true,
            ]
        );

        // Assign all permissions to super admin
        $superAdminRole->permissions()->sync(Permission::all()->pluck('id'));

        // Assign all permissions to admin as well
        $adminRole->permissions()->sync(Permission::all()->pluck('id'));

        // Pengguna role has no permissions by default
        $penggunaRole->permissions()->sync([]);

        // Update existing users to link with role_id
        // Note: 'superadmin' users should be manually assigned or handled separately
        User::where('role', 'pengguna')->whereNull('role_id')->update(['role_id' => $penggunaRole->id]);
    }
}
