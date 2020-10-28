<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 *
 * @OA\Schema(
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", description="Name",example="Category name"),
 * @OA\Property(property="short_description", type="string", description="", example="",nullable=true),
 * @OA\Property(property="description", type="string", description="", example=""),
 * @OA\Property(property="order", type="integer", description="Sort order in menu", example=1),
 * @OA\Property(property="parent_id", type="integer", nullable=true, description="Parent category id", default=null, readOnly="true"),
 * @OA\Property(property="parent", type="object", @OA\Schema(ref="#/components/schemas/Category")),
 * @OA\Property(property="children", type="array", @OA\Items(@OA\Schema(ref="#/components/schemas/Category"))),
 * @OA\Property(property="created_at", ref="#/components/schemas/Model/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/Model/properties/updated_at"),
 * @OA\Property(property="deleted_at", ref="#/components/schemas/Model/properties/deleted_at")
 * )
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_description', 'description', 'order'];

    protected $with = ['parent', 'children'];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
