<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * @OA\Schema(
     * schema="Product",
     * required={"name", "price", "description"},
     * @OA\Property(property="id", type="integer", example="1"),
     * @OA\Property(property="name", type="string", description="Product name",  example="Product name"),
     * @OA\Property(property="description", type="string", description="", example=""),
     * @OA\Property(property="category", ref="#/components/schemas/Category",  readOnly=true),
     * @OA\Property(property="price", type="integer", example="100"),
     * @OA\Property(property="sale_price", type="integer", example="99"),
     * @OA\Property(property="units", type="integer", example="10"),
     * @OA\Property(property="is_available", type="boolean", example=false),
     * @OA\Property(property="is_recommended", type="boolean", example=false),
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
