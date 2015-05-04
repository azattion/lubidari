<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'phone', 'address', 'options', 'count', 'delivery_date', 'delivery_time', 'desc'];

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('order_items', 'id_order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('users', 'user_id');
    }

}
