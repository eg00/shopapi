<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    /**
     * @OA\Get(
     *      path="/admin/orders",
     *      operationId="getOrdersList",
     *      tags={"Admin/Orders"},
     *      summary="Get list of orders",
     *      description="Returns list of orders",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean"),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Order")),
     *          )
     *       )
     *     )
     */

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders = Order::all();

        return response()->json(
            [
                'success' => true,
                'data' => OrderResource::collection($orders)
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $product = Order::query()->create($request->all());

        return response()->json(
            [
                'success' => true,
                'data' => new OrderResource($product)
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return JsonResponse
     */
    public function show(Order $order): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'data' => new OrderResource($order)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Order  $order
     * @return JsonResponse
     */
    public function update(Request $request, Order $order): JsonResponse
    {
        $order->update($request->all());

        return response()->json(
            [
                'success' => true,
                'data' => new OrderResource($order)
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order  $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json(
            [
                'success' => true
            ],
            Response::HTTP_NO_CONTENT
        );
    }
}
