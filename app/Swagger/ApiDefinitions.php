<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     title="API Ecommerce Gmedia",
 *     version="1.0.0",
 *     description="Dokumentasi API untuk Ecommerce Gmedia",
 *     @OA\Contact(
 *         email="admin@example.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     in="header",
 *     bearerFormat="JWT"
 * )
 */

class ApiDefinitions {}
