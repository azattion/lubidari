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

}
