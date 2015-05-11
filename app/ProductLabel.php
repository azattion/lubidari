<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLabel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['id_prod', 'id_lab'];

    /**
     * @var array
     */
    protected $guarded = ['id'];


}
