<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/05/19
 * Time: 15:05
 */

namespace App\Repositories;


use App\Base\BaseRepository;
use App\Models\Sale;

class SalesRepository extends BaseRepository
{
    /**
     * Get model
     *
     * @return void
     */
    public function getModel()
    {
        $this->model = new Sale();
    }
}
