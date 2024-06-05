<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use DB;
use Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::orderBy('indexing', 'asc')->paginate(5);
        return view('admin.product-categories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $request['slug'] = Str::slug($request['name']);
            // INSERT INTO product_categories VALUES()
            $productCategory = ProductCategory::create($request->all());
            DB::commit();
            return redirect()->route('admin.product-categories.index')->withSuccess('Create Product Category Success');
        } catch (\Exception $exp) {
            DB::rollback();
            return redirect()->back()->withErrors($exp->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        return view('admin.product-categories.show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        try {
            DB::beginTransaction();
            $request['slug'] = Str::slug($request['name']);
            // UPDATE product_categories SET()
            $productCategory->update($request->all());
            DB::commit();
            return redirect()->route('admin.product-categories.index')->withSuccess('Update Product Category Success');
        } catch (\Exception $exp) {
            DB::rollback();
            return redirect()->back()->withErrors($exp->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        try {
            DB::beginTransaction();
            // DELETE * FROM product_categories
            $productCategory->delete();
            DB::commit();
            return redirect()->route('admin.product-categories.index')->withSuccess('Delete Product Category Success');
        } catch (\Exception $exp) {
            DB::rollback();
            return redirect()->route('admin.product-categories.index')->withErrors($exp->getMessage())->withInput();
        }
    }
}
