<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

    /**
     * @var array
     */
	protected $fillable = ['id_prod','title','filename', 'url'];

    /**
     * @var array
     */
    protected $guarded = ['id','created_at','updated_at'];
}
