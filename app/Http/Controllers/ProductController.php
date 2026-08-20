<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($categorySlug,$productSlug, $variantSlug = null)
    {
        $category=Category::where('slug',$categorySlug)->firstOrFail();
        $product = Product::where('slug', $productSlug)
            ->firstOrFail();

        $variant = null;

        if ($variantSlug != null) {

            $variant = $product->getProductVariation()
                ->where('slug', $variantSlug)
                ->firstOrFail();

        }

        return view('product.index', compact('product', 'variant', 'category'));
    }





}
