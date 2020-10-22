<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 *
 * @OA\Schema(
 * required={"name", "password", "email"},
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", description="User name"),
 * @OA\Property(property="email", type="string",  format="email", description="User unique email address", example="user@gmail.com"),
 * @OA\Property(property="role", type="string", description="User role"),
 * @OA\Property(property="password", type="string", example="password"),
 * @OA\Property(property="created_at", ref="#/components/schemas/Model/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/Model/properties/updated_at"),
 * )
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return self::where('email', $value)->orWhere('id', $value)->firstOrFail();
    }
}
