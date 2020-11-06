<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    /**
     * @OA\Schema(
     * schema="Order",
     * required={"name", "price", "description"},
     * @OA\Property(property="id", type="integer", example="1", readOnly=true),
     * @OA\Property(property="user_id", type="integer", description="User id",  example="1"),
     * @OA\Property(property="delivery_method_id", type="integer", description="", example="1"),
     * @OA\Property(property="comment", type="string", description=""),
     * @OA\Property(property="status_id", type="integer", description="", example="1"),
     * @OA\Property(property="count", type="integer", description=" Count of products", example="75", readOnly=true),
     * @OA\Property(property="total", type="integer", description=" total price", example="359298", readOnly=true),
     * @OA\Property(property="user", ref="#/components/schemas/User", readOnly=true),
     * @OA\Property(property="product", type="array", @OA\Items(ref="#/components/schemas/Product"), readOnly=true),
     * @OA\Property(property="created_at", ref="#/components/schemas/Model/properties/created_at", readOnly=true),
     * @OA\Property(property="updated_at", ref="#/components/schemas/Model/properties/updated_at", readOnly=true),
     * )
     */

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
