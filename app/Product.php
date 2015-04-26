<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpSpec\Exception\Exception;

class Product extends Model
{
    protected $fillable = ['title', 'price', 'consist', 'desc', 'boxing', 'size', 'weight', 'prod_time'];
    protected $guarded = ['id'];

    public static $rules = [
        'title' => 'required|min:2|max:255',
        'price' => 'required|numeric',
        'consist' => 'required|min:2|max:255',
        'desc' => 'required|min:2|max:255',
        'boxing' => 'required|min:2|max:255',
        'size' => 'required|min:2|max:255',
        'weight' => 'required|numeric',
        'prod_time' => 'required|numeric'
    ];

    public static function add($data)
    {
        try {
            Product::create([
                'title' => $data['title'],
                'price' => $data['price'],
                'consist' => $data['consist'],
                'desc' => $data['desc'],
                'boxing' => $data['boxing'],
                'size' => $data['size'],
                'weight' => $data['weight'],
                'prod_time' => $data['prod_time']
            ]);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public static function up_data($id,$data)
    {
        try {
            $product = Product::find($id);
            $product::update([
                'title' => $data['title'],
                'price'=>$data['price'],
                'consist'=>$data['consist'],
                'desc'=>$data['desc'],
                'boxing'=>$data['boxing'],
                'size'=>$data['size'],
                'weight'=>$data['weight'],
                'prod_time'=>$data['prod_time'],
            ]);

        } catch (\Exception $e) {

        }

    }

}
