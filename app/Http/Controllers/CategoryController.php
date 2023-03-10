<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   /* public function index()
    {
        $categories = Category::whereNull('category_id')
            ->with(['subcategories'=>function($query){
                $query->withCount('products');
            }])->get();

        return view('categories.index', compact('categories'));
    }*/

    public function index()
    {
        $categories = Category::whereNull('category_id')
            ->where('status',1)
            ->with(['subcategories'=>function($query){
                $query->where('status',1);
            }])
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('subcategories.subcategories');

        $subcategoryIDs = [$category->id];
        foreach ($category->subcategories as $subcategory) {
            $subcategoryIDs[] = $subcategory->id;
            foreach ($subcategory->subcategories as $subsubcategory) {
                $subcategoryIDs[] = $subsubcategory->id;
            }
        }
/*echo "<pre>";
        print_r($subcategoryIDs);
echo "</pre>";die;*/

        $products = Product::whereHas('categories',function ($query)use($subcategoryIDs){
            $query->whereIn('categories.id',$subcategoryIDs);
        })->get();

        return view('categories.show', compact('category', 'products'));
    }

    public function create()
    {
        return view('categories.create');
    }
}
