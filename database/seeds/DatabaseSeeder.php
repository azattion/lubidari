<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('ProductTableSeeder');
    }

}

class ProductTableSeeder extends Seeder
{

    public function run()
    {

        for ($i = 1; $i < 30; $i++) {
            $prod = new Product();
            $prod->title = 'Title '.$i;
            $prod->price = $i++;
            $prod->save();
        }
    }

}
