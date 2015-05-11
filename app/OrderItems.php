<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItems extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * @var string
     */
    public $table = 'order_items';

    /**
     * @var array
     */
    protected $fillable = ['is_user', 'id_order', 'id_prod'];

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo('orders', 'id');
    }

    public function product()
    {
        return $this->belongsTo('products', 'id');
    }

    public function user()
    {
        return $this->belongsTo('users', 'id');
    }

}
