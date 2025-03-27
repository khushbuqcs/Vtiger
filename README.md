<!-- Run the project -->

php artisan serve --port=8081

<!-- Clear Commands -->

php artisan config:cache

php artisan config:clear

php artisan route:cache

php artisan route:clear

php artisan optimize --force

<!-- Refresh Database -->

php artisan migrate:fresh -seed

<!-- Project Setup :  -->

khushbujoshi@qcs1:/var/www/html/vtiger-11-api$ composer global require laravel/installer

khushbujoshi@qcs1:/var/www/html/vtiger-11-api$ laravel new vtiger-11-api

khushbujoshi@qcs1:/var/www/html/vtiger-11-api$ cd vtiger-11-api

php artisan install:api

<!-- Controller -->

mkdir -p app/Controllers/Auth

php artisan make:controller Auth/BaseController

php artisan make:controller Auth/AuthController

php artisan make:controller SearchController

php artisan make:controller EmailController

php artisan make:controller ModuleController

php artisan make:controller TagController

php artisan make:controller CommentController

php artisan make:controller DescribeController

php artisan make:controller HistoryController

<!-- Service -->

mkdir -p app/Services

touch app/Services/AuthService.php

touch app/Services/SearchService.php

touch app/Services/EmailService.php

touch app/Services/ModuleService.php

touch app/Services/TagService.php

touch app/Services/CommentService.php

touch app/Services/DescribeService.php

touch app/Services/HistoryService.php

<!-- Repositories -->

mkdir -p app/Repositories && touch app/Repositories/AuthRepository.php

<!-- Trait -->

mkdir -p app/Traits && touch app/Repositories/VtigerRequestTrait.php

<!-- Test Cases -->

php artisan make:test AuthApiTest

php artisan make:test EmailApiTest

php artisan make:test SearchApiTest

php artisan make:test ModuleApiTest

php artisan make:test TagApiTest

php artisan make:test CommentApiTest

php artisan make:test DescribeApiTest

php artisan make:test HistoryApiTest

<!-- Middleware -->

php artisan make:middleware CheckVtigerSession

<!-- Swagger Command -->

composer require "darkaonline/l5-swagger"

php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

mkdir -p app/Swagger

touch app/Swagger/SwaggerDocumentation.php

php artisan l5-swagger:generate

Run : http://127.0.0.1:8081/api/documentation
