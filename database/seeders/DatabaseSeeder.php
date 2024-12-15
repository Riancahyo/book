<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     CategorySeeder::class,
        //     BookSeeder::class,
        // ]);

        // Menghapus user lama dengan email 'test@example.com' jika ada
        User::where('email', 'test@example.com')->delete();

        // Membuat User baru dengan email unik
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],  // Cek apakah email sudah ada
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),  // Pastikan memberikan password
            ]
        );

        // Membuat role jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user'], ['guard_name' => 'web']);

        // Membuat permissions jika belum ada
        $viewPostsPermission = Permission::firstOrCreate(['name' => 'view posts'], ['guard_name' => 'web']);
        $createPostsPermission = Permission::firstOrCreate(['name' => 'create posts'], ['guard_name' => 'web']);

        // Memberikan permissions ke admin role
        $adminRole->givePermissionTo($viewPostsPermission);
        $adminRole->givePermissionTo($createPostsPermission);

        // Memberikan permissions ke user role
        $userRole->givePermissionTo($viewPostsPermission);

        // Assign role 'admin' ke user pertama
        $user->assignRole('admin');
    }
}
