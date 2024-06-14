<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsSeeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(PermissionsSeeder::class);
        
        User::factory()->create([
            'name' => 'odin',
            'email' => 'odin@mail.com',
        ]);
        User::factory()->create([
            'name' => 'pepito',
            'email' => 'pepito@mail.com',
        ]);
        $user = User::find(1);
        $user->assignRole('admin');
        $user->givePermissionTo('administrar sitio');

        $user2 = User::find(2);
        $user2->assignRole('registered');
        $user2->givePermissionTo('descargar libros');


   // Book::factory()->count(2)->create();

    Category::insert([
            ['name' => 'FICCION'],
            ['name' => 'NO FICCION'],
            ['name' => 'MISTERIO'],
            ['name' => 'SUSPENSO'],
            ['name' => 'CIENCIA FICCION'],
            ['name' => 'FANTASIA'],
            ['name' => 'FICCION HISTORICA'],
            ['name' => 'ROMANCE'],
            ['name' => 'TERROR'],
            ['name' => 'BIOGRAFIA'],
            ['name' => 'AUTOAYUDA'],
            ['name' => 'JUVENIL'],
            ['name' => 'INFANTIL'],
            ['name' => 'POESIA'],
            ['name' => 'OTROS']
            
        ]);
        // Author::insert([
        //     ["name" => "Gabriel García Márquez"],
        //         ["name" => "Jane Austen" ],
        //         ["name" => "George Orwell"],
        //         ["name" => "J.K. Rowling"],
        //         ["name" => "Mark Twain"],
        //         ["name" => "Ernest Hemingway"],
        //         ["name" => "Leo Tolstoy"],
        //         ["name" => "Charles Dickens"],
        //         ["name" => "Fyodor Dostoevsky"],
        //         ["name" => "Virginia Woolf"]
        // ]);

        // Book::factory()
        // ->has(Category::factory()->count(3))
        // ->count(3)
        // ->create();

        



    }

    
}
