<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = array_map(static fn($role) => ['name' => $role->value], Roles::cases());

        foreach($roles as $role) {
            (new Role())->firstOrCreate($role);
        }

        
    }
}
