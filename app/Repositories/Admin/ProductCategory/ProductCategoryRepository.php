<?php

namespace App\Repositories\Admin\ProductCategory;

use App\Models\ProductCategory as Model;
use App\Repositories\CoreRepository;

/**
 * Class ProductCategoryRepository
 *
 * @package App\Reposiroties\Admin
 */
class ProductCategoryRepository extends CoreRepository
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
