<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json(
            [
                'success' => true,
                'data' => $categories
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $category = new Category($request->all());

        if ($category->save()) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $category
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'Category not added'
            ],
            500
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        if (!$category) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Category not found '
                ],
                400
            );
        }
        return response()->json(
            [
                'success' => true,
                'data' => $category
            ],
            400
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        if (!$category) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Category not found'
                ],
                400
            );
        }

        $updated = $category->fill($request->all())->save();

        if ($updated) {
            return response()->json(
                [
                    'success' => true
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'Category can not be updated'
            ],
            500
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        if (!$category) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Category not found'
                ],
                400
            );
        }

        if ($category->delete()) {
            return response()->json(
                [
                    'success' => true
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'Category can not be deleted'
            ],
            500
        );
    }
}
