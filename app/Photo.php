<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['id_prod', 'title', 'filename', 'url'];

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
