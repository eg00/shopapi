<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * @OA\Schema(
 *     required={"created_at","updated_at"},
 * @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
 * @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
 * @OA\Property(property="deleted_at", type="string", format="date-time", description="Soft delete timestamp", readOnly="true"),
 * )
 *
 */
abstract class Model extends BaseModel
{

}
