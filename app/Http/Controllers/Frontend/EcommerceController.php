<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Product;
use Modules\Ecommerce\Entities\Category;

class EcommerceController extends Controller
{
    public function getProductsByCategory($cateSlug)
    {  
        $category = Category::where('slug', $cateSlug)->first();

        $page_data = [
            'title' => $category['name'],
            'seo_title' => $category['name'],
            'seo_description' => $category['name'],
            'seo_keyword' => $category['name']
        ];

        return view('katitheme.pages.p-category')->with(['page_data' => $page_data]);
    }
}
