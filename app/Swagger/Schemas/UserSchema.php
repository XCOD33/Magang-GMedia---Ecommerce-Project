<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="User",
 *     required={"email", "name"},
 *     @OA\Property(property="id", type="string", format="cuid", example="cuid123456789"),
 *     @OA\Property(property="name", type="string", maxLength=32, example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="role", type="string", enum={"admin", "seller", "buyer"}, example="buyer"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class UserSchema {}
