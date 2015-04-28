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

        //$this->call('ProductTableSeeder');
    }

}

class ProductTableSeeder extends Seeder
{

    public function run()
    {

        for ($i = 1; $i < 15; $i++) {
            $prod = new Product();
            $prod->title = "Product ". $i;
            $prod->price = "500". $i;
            $prod->desc = "Product desc". $i;
            $prod->consist = "Product consisit ". $i;
            $prod->boxing = "Product boxing ". $i;
            $prod->size = "50*50*". $i;
            $prod->weight = $i*10;
            $prod->prod_time = $i;
            $prod->save();
        }
    }

}
