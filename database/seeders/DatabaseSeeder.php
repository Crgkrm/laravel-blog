<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run():void
    {
    
       //\App\Models\Post::factory(50)->create();
        $adminUser=User::factory()->create([
          'email'=>'admin@gmail.com',
          'name'=>'Admin',
          'password'=>bcrypt('admin123'),

        ]);
     //create role using spatie package//
     $adminRole=Role::create(['name'=>'admin']);
     //assign role//
     $adminUser->assignRole($adminRole);
     
    }
}
