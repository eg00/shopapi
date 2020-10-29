<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/admin/products",
     *      path="/products",
     *      operationId="getProductsList",
     *      tags={"Admin/Products", "Products"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean"),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Product")),
     *          )
     *       )
     *     )
     */

    /**
     * Display a listing of the products.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all();
        return response()->json(
            [
                'success' => true,
                'data' => $products
            ]
        );
    }

    /**
     * @OA\Post (
     *     path="/admin/products",
     *     operationId="storeProduct",
     *     tags={"Admin/Products"},
     *     summary="Store new product",
     *     description="Return project data",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean"),
     *                  @OA\Property(property="data", ref="#/components/schemas/Product"),
     *              )
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean", example="false"),
     *                  @OA\Property(property="errors", type="object"),
     *              )
     *      )
     * ),
     */

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json(
            [
                'success' => true,
                'data' => new ProductResource($product)
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Get(
     *      path="/admin/products/{id}",
     *      path="/products/{id}",
     *      operationId="getProductsById",
     *      tags={"Admin/Products", "Products"},
     *      summary="Get product by id",
     *      description="Returns product data",
     *      @OA\Parameter(
     *          name="id",
     *          description="product id",
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
     *                  @OA\Property(property="data", ref="#/components/schemas/Product"),
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

    /**
     * Display the specified product.
     *
     * @param  Product  $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'data' => new ProductResource($product)
            ]
        );
    }

    /**
     * @OA\Put(
     *      path="/admin/products/{id}",
     *      operationId="updateProduct",
     *      tags={"Admin/Products"},
     *      summary="Update existing product",
     *      description="Returns updated product data",
     *      @OA\Parameter(
     *          name="id",
     *          description="product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *      ),
     *     @OA\Response(
     *          response=202,
     *          description="Success",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean"),
     *                  @OA\Property(property="data", ref="#/components/schemas/Product"),
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
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean", example="false"),
     *                  @OA\Property(property="errors", type="object"),
     *              )
     *      )
     * )
     */

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $product->update($request->all());

        return response()->json(
            [
                'success' => true,
                'data' => new ProductResource($product)
            ]
        );
    }

    /**
     * @OA\Delete (
     *      path="/admin/products/{id}",
     *      operationId="deleteProductById",
     *      tags={"Admin/Products"},
     *      summary="Delete product by id",
     *      description="Deletes a product and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="product id",
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
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */

    /**
     * Remove the specified product from storage.
     *
     * @param  Product  $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(
            [
                'success' => true
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
