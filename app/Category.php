<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['title', 'desc', 'keywords'];

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function products(){
        return $this->hasMany('App\Product','id_cat');
    }
}
