<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $latest = Product::query()->latest()->limit(20)->get();
        $popular = Product::orderByViews()->limit(10)->get();

        return response()->view('index', compact( 'latest', 'popular'));

    }
}
