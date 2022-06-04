<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::all()->toArray();

        return array_reverse($productCategories);
    }

    public function add(Request $request)
    {
        $productCategory = new ProductCategory([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        $productCategory->save();

        return response()->json('The Product Category successfully added');
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

    public function update($id, Request $request)
    {
        $gate = Gate::inspect('update-productCategory');

        if($gate->denied()) {
            return response('You are not allowed to edit this item', 403);
        }

        $productCategory = ProductCategory::find($id);

        $productCategory->update($request->all());

        return response()->json("The Product Category successfully updated");
    }

    public function delete($id)
    {
        $gate = Gate::inspect('delete-productCategory');

        if($gate->denied()) {
            return response('You are not allowed to delete this item', 403);
        }

        $productCategory = ProductCategory::find($id);

        $productCategory->delete();

        return response()->json('The Product Category successfully deleted');
    }

}
