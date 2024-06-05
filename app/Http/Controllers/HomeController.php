<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeaderImage;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $headerImages = HeaderImage::all();
        $productCategories = ProductCategory::all();

        return view ('welcome', compact('headerImages', 'productCategories'));
    }
}
