<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpSpec\Exception\Exception;

class Product extends Model
{
    protected $fillable = ['title', 'price', 'consist', 'desc', 'boxing', 'size', 'weight', 'prod_time'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo', 'id_prod');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }
}
