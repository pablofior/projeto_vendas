<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/05/19
 * Time: 14:48
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Sale;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'price'
    ];

    /**
     * Sale relation
     *
     * @return HasMany
     */
    public function sales()
    {
        return $this->hasMany(
            Sale::class,
            'product_id',
            'id'
        );
    }
}
