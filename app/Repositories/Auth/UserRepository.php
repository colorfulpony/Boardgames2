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

    /**
     * Get model to update in admin
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Get Product Categories with paginate
     *
     * @param int $id
     *
     * @return Model
     */
    public function getProductCategoriesWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'slug', 'description'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);
            dd($result);
    }

    /**
     * Get Product Categories with paginate
     *
     * @param int $id
     *
     * @return Model
     */
    public function getProductCategoriesForIndex()
    {
        $columns = ['id', 'title', 'slug', 'description'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderByDesc('id')
            ->get();

        return $result;
    }
}
