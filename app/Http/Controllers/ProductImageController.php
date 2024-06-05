<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\Product;
use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;
use DB;
use Str;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->orderBy('indexing', 'asc')->paginate(5);
        return view('admin.products.product-images.index', compact('product', 'productImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.products.product-images.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductImageRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $request['product_id'] = $product->id;
            // INSERT INTO product_images VALUES()
            $productImage = ProductImage::create($request->all());
            DB::commit();
            return redirect()->route('admin.products.product-images.index', compact('product'))->withSuccess('Create Product Image Success');
        } catch (\Exception $exp) {
            DB::rollback();
            return redirect()->back()->withErrors($exp->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, ProductImage $productImage)
    {
        return view('admin.products.product-images.show', compact('product', 'productImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, ProductImage $productImage)
    {
        return view('admin.products.product-images.edit', compact('product', 'productImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductImageRequest $request, Product $product, ProductImage $productImage)
    {
        try {
            DB::beginTransaction();
            $request['product_id'] = $product->id;
            // UPDATE products SET()
            $productImage->update($request->all());
            DB::commit();
            return redirect()->route('admin.products.product-images.index', compact('product'))->withSuccess('Update Product Image Success');
        } catch (\Exception $exp) {
            DB::rollback();
            return redirect()->back()->withErrors($exp->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductImage $productImage)
    {
        try {
            DB::beginTransaction();
            // DELETE * FROM products
            $productImage->delete();
            DB::commit();
            return redirect()->route('admin.products.product-images.index', compact('product'))->withSuccess('Delete Product Image Success');
        } catch (\Exception $exp) {
            DB::rollback();
            return redirect()->route('admin.products.product-images.index', compact('product'))->withErrors($exp->getMessage())->withInput();
        }
    }
}
