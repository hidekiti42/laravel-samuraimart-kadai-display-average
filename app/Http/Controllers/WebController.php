<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MajorCategory;
use App\Models\Product;

class WebController extends Controller
{
    public function index()
    {
        $major_categories = MajorCategory::with('categories')->get();

        $categories = Category::all();

        $recently_products = Product::orderBy('created_at', 'desc')->take(4)->get();
        $recommend_products = Product::where('recommend_flag', true)->take(3)->get();

        $featured_products = Product::withAvg('reviews', 'score')->orderBy('reviews_avg_score', 'desc')->take(4)->get();

        return view('web.index', compact('major_categories', 'recently_products', 'recommend_products', 'featured_products'));
    }
}

