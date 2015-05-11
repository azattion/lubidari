<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpSpec\Exception\Exception;
use App\Category;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'id_cat', 'price', 'consist', 'desc', 'boxing', 'size', 'weight', 'prod_time'];
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
        return $this->belongsTo('App\Category', 'id_cat');
    }
}
