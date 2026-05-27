<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Jjuuko Ronald',
            'email' => 'ronaldjjuuko7@gmail.com',
            'password' => bcrypt('88928892'),
        ]);
    }
}
