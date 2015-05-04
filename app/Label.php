<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model {

    /**
     * @var array
     */
    protected $fillable = ['title','id_cat'];

    /**
     * @var array
     */
    protected $guarded = ['id','created_at','updated_at'];

    /**
     * @var array
     */
    public static $category = [1=>'Праздник', 2=>'Кому дарить?', 3=>'Цвет композиции'];

}
