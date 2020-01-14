<?php

namespace App\Repositories;

use App\Base\BaseRepository;
use App\Models\User;

class UsersRepository extends BaseRepository
{
    /**
     * Get model
     *
     * @return void
     */
    public function getModel()
    {
        $this->model = new User();
    }
}
