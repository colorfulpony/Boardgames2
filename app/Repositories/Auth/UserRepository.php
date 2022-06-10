<?php

namespace App\Repositories\Auth;

use App\Models\User as Model;
use App\Repositories\CoreRepository;

/**
 * Class ProductCategoryRepository
 *
 * @package App\Reposiroties\Auth\User
 */
class UserRepository extends CoreRepository
{
    /**
     * Main function for ProductCategoryRepository
     *
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
