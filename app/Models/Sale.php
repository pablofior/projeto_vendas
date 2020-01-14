<?php

/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/05/19
 * Time: 15:04
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'item_price',
        'total',
        'quantity'
    ];

    /**
     * Product relation
     *
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id',
            'id',
            __FUNCTION__
        );
    }

    /**
     * User relation
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id',
            __FUNCTION__
        );
    }
}
