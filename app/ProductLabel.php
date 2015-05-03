<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLabel extends Model {

    /**
     * @var array
     */
	protected $fillable = ['id_prod','id_lab'];

    /**
     * @var array
     */
    protected $guarded = ['id'];


}
