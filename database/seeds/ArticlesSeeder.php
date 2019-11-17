<?php

use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        // $users = App\User::get()->where();

        $users->each(
            function($user){
                $user->articles()->save(
                    factory(App\Article::class)->make()
                );
            }
        );
    }
}
