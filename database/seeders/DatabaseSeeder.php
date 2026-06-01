<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ImproveRolesAndPermissionsSeeder::class);
        $this->call(EcommerceDemoSeeder::class);

        $user = User::query()->firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => 'password',
            'status' => true,
            'notifications_enabled' => true,
        ]);

        if ($role = Role::query()->where('name', 'super_admin')->first()) {
            $user->syncRoles([$role->name]);
        }
    }
}
