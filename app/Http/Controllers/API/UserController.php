<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *      path="/admin/users",
     *      operationId="getUsersList",
     *      tags={"Admin/Users"},
     *      summary="Get list of users",
     *      description="Returns list of users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean"),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/User")),
     *          )
     *       )
     *     )
     *    security={}
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json(
            [
                'success' => true,
                'data' => $users
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
     *     path="/admin/users",
     *     operationId="storeUser",
     *     tags={"Admin/Users"},
     *     summary="Store new user",
     *     description="Return user data",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean"),
     *                  @OA\Property(property="data", ref="#/components/schemas/User"),
     *              )
     *      )
     * ),
     */
    public function store(Request $request)
    {
        $user = new User($request->all());

        if ($user->save()) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $user
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'User not added'
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * Display the specified user.
     *
     * @param  User  $user
     * @return JsonResponse
     *
     * @OA\Get(
     *      path="/admin/users/{id}",
     *      operationId="getUserById",
     *      tags={"Admin/Users"},
     *      summary="Get user by id",
     *      description="Returns user",
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              ref="#/components/schemas/User/properties/id"
     *          )
     *      ),

     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean"),
     *                  @OA\Property(property="data", ref="#/components/schemas/User"),
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
    public function show(User $user)
    {
        return response()->json(
            [
                'success' => true,
                'data' => $user
            ]
        );
    }

    /**
     * Update the specified user in storage.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return JsonResponse
     *
     * @OA\Put(
     *      path="/admin/users/{id}",
     *      operationId="updateUser",
     *      tags={"Admin/Users"},
     *      summary="Update existing user",
     *      description="Returns updated user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *      ),
     *     @OA\Response(
     *          response=202,
     *          description="Success",
     *              @OA\JsonContent(
     *                  @OA\Property(property="success", type="boolean"),
     *                  @OA\Property(property="data", ref="#/components/schemas/User"),
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
    public function update(Request $request, User $user) : JsonResponse
    {
        $updated = $user->fill($request->all())->save();

        if ($updated) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $user
                ],
                Response::HTTP_ACCEPTED
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'User can not be updated'
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  User  $user
     * @return JsonResponse
     * @throws \Exception
     *
     * @OA\Delete (
     *      path="/admin/users/{id}",
     *      operationId="deleteUserById",
     *      tags={"Admin/Users"},
     *      summary="Delete user by id",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
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
    public function destroy(User $user): JsonResponse
    {
        if ($user->delete()) {
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
