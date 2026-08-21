<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($categorySlug,$productSlug, $variantid = null)
    {
        $category=Category::where('slug',$categorySlug)->firstOrFail();
        $product = Product::where('slug', $productSlug)
            ->firstOrFail();

        $getvariant =$product->getProductVariation()->get() ;
        $variant = null;


        if ($variantid != null) {

            $variant = $product->getProductVariation()
                ->where('id', $variantid)
                ->firstOrFail();

        }

        return view('product.index', compact('product', 'variant', 'category', 'getvariant'));
    }





}
