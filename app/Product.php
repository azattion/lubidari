<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpSpec\Exception\Exception;

class Product extends Model
{
    protected $fillable = ['title', 'price', 'consist', 'desc', 'boxing', 'size', 'weight', 'prod_time'];
    protected $guarded = ['id'];
}
