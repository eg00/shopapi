<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *      path="admin/categories",
     *      operationId="getCategoriesList",
     *      tags={"Admin/Categories"},
     *      summary="Get list of categories",
     *      description="Returns list of categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean"),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Category")),
     *          )
     *       )
     *     )
     *    security={}
     */
    public function index(): JsonResponse
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
     * @param  Request  $request
     * @return JsonResponse
     *
     * @OA\Post (
     *     path="admin/categories",
     *     operationId="storeCategory",
     *     tags={"Admin/Categories"},
     *     summary="Store new category",
     *     description="Return project data",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean"),
     *                  @OA\Property(property="data", ref="#/components/schemas/Category"),
     *              )
     *      )
     * ),
     */
    public function store(Request $request): JsonResponse
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
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return JsonResponse
     *
     * @OA\Get(
     *      path="admin/categories/{id}",
     *      operationId="getCategoryById",
     *      tags={"Admin/Categories"},
     *      summary="Get category by id",
     *      description="Returns category data",
     *      @OA\Parameter(
     *          name="id",
     *          description="category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean"),
     *                  @OA\Property(property="data", ref="#/components/schemas/Category"),
     *              )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'data' => $category
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Category  $category
     * @return JsonResponse
     *
     * @OA\Put(
     *      path="admin/categories/{id}",
     *      operationId="updateCategory",
     *      tags={"Admin/Categories"},
     *      summary="Update existing category",
     *      description="Returns updated category data",
     *      @OA\Parameter(
     *          name="id",
     *          description="category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Category")
     *      ),
     *     @OA\Response(
     *          response=202,
     *          description="Success",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean"),
     *                  @OA\Property(property="data", ref="#/components/schemas/Category"),
     *              )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(Request $request, Category $category): JsonResponse
    {

        $updated = $category->fill($request->all())->save();

        if ($updated) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $category
                ],
                Response::HTTP_ACCEPTED
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'Category can not be updated'
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return JsonResponse
     * @throws Exception
     *
     * @OA\Delete (
     *      path="admin/categories/{id}",
     *      operationId="deleteCategoryById",
     *      tags={"Admin/Categories"},
     *      summary="Delete category by id",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2": {"write:categories", "read:categories"}
     *         }
     *     },
     * )
     */
    public function destroy(Category $category): JsonResponse
    {

        if ($category->delete()) {
            return response()->json(
                [
                    'success' => true
                ],
                Response::HTTP_NO_CONTENT
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'Category can not be deleted'
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
