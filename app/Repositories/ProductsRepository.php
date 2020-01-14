<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/05/19
 * Time: 14:46
 */

namespace App\Repositories;


use App\Base\BaseRepository;
use App\Models\Product;

class ProductssRepository extends BaseRepository
{
    /**
     * Get model
     *
     * @return void
     */
    public function getModel()
    {
        $this->model = new Product();
    }
}
