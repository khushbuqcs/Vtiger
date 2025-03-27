<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="Vtiger API",
 *      version="1.0.0",
 *      description="API documentation for your Vtiger application",
 *      @OA\Contact(
 *          email="your-email@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="sessionAuth",
 *     type="apiKey",
 *     in="header",
 *     name="PHPSESSID",
 *     description="Session ID for authentication"
 * )

 */
class SwaggerDocumentation
{
    
}
