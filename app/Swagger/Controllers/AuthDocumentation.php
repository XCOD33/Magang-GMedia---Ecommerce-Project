<?php

namespace App\Swagger\Controllers;

/**
 * @OA\Post(
 *     path="/api/auth/login",
 *     operationId="authLogin",
 *     tags={"Authentication"},
 *     summary="Login user",
 *     description="Mengembalikan token JWT",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email","password"},
 *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="password123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Login successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Login successful"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGc..."),
 *                 @OA\Property(property="token_type", type="string", example="bearer"),
 *                 @OA\Property(property="expires_in", type="integer", example=3600)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Invalid credentials")
 *         )
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/auth/user",
 *     operationId="authMe",
 *     tags={"Authentication"},
 *     summary="Get authenticated user information",
 *     description="Mengembalikan informasi user yang sedang login",
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="User information retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="User retrieved successfully"),
 *             @OA\Property(property="data", type="object", example={"id": 1, "name": "John Doe", "email": "john.doe@example.com"})
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Unauthorized")
 *          )
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/auth/logout",
 *     operationId="authLogout",
 *     tags={"Authentication"},
 *     summary="Logout user",
 *     description="Logout user dan invalidate token",
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successfully logged out",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Successfully logged out")
 *         )
 *     ),
 *     @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=false),
 *              @OA\Property(property="message", type="string", example="Unauthorized")
 *          )
 *      )
 * )
 *
 * @OA\Post(
 *     path="/api/auth/refresh",
 *     operationId="authRefresh",
 *     tags={"Authentication"},
 *     summary="Refresh token",
 *     description="Merefresh token JWT",
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Token refreshed successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Successfully logged in"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGc..."),
 *                 @OA\Property(property="token_type", type="string", example="bearer"),
 *                 @OA\Property(property="expires_in", type="integer", example=3600)
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=false),
 *              @OA\Property(property="message", type="string", example="Unauthorized")
 *          )
 *      )
 * )
 */
class AuthDocumentation {}
