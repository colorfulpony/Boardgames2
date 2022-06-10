<?php

namespace App\Http\Controllers\API\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\StoreRequest;
use App\Http\Requests\ProductCategory\UpdateRequest;
use App\Models\ProductCategory;
use App\Repositories\Admin\ProductCategory\ProductCategoryRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    private $productCategoryRepository;

    public function __construct()
    {
        $this->productCategoryRepository = app(ProductCategoryRepository::class);
    }

    public function index()
    {
        $productCategories = $this->productCategoryRepository->getProductCategoriesForIndex();

        return $productCategories;
    }

    public function add(StoreRequest $storeRequest)
    {
        if ($storeRequest->validated()) {
            try {
                $data = $storeRequest->input();

                if (empty($data['slug'])) {
                    $data['slug'] = Str::slug($data['title']);
                }

                ProductCategory::create($data);

                $success = true;
                $message = 'The Product Category successfully added';
            } catch (QueryException $ex) {
                $success = false;
                $message = $ex->getMessage();
            }
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

    public function edit($id)
    {
        $gate = Gate::inspect('update-productCategory');

        if($gate->denied()) {
            return response('You are not allowed to edit this item', 403);
        }

        $productCategory = ProductCategory::find($id);

        return $productCategory;
    }

    public function update($id, UpdateRequest $updateRequest)
    {
        $gate = Gate::inspect('update-productCategory');

        if($gate->denied()) {
            return response('You are not allowed to edit this item', 403);
        }

        if ($updateRequest->validated()) {
            try {
                $productCategory = ProductCategory::find($id);

                $productCategory->update($updateRequest->all());

                $success = true;
                $message = 'The Product Category successfully updated';
            } catch (QueryException $ex) {
                $success = false;
                $message = $ex->getMessage();
            }
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

    public function delete($id)
    {
        $gate = Gate::inspect('delete-productCategory');

        if($gate->denied()) {
            return response('You are not allowed to delete this item', 403);
        }

        try {
            $productCategory = ProductCategory::find($id);

            $productCategory->delete();

            $success = true;
            $message = 'The Product Category successfully deleted';
        } catch (QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

}
