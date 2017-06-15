<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

 $app->withFacades();

 $app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// https://stackoverflow.com/questions/36086846/lumen-dingo-jwt-is-not-instantiable-while-building
$app->singleton(
    Illuminate\Cache\CacheManager::class,
    function ($app) {
        return $app->make('cache');
    }
);

$app->singleton(
    Illuminate\Auth\AuthManager::class,
    function ($app) {
        return $app->make('auth');
    }
);
///////////////////////////////////////////////////////////////////////////////////////////////////

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//    App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->middleware([
//   \Neomerx\CorsIlluminate\CorsMiddleware::class,
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);


/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);


$app->register(Barryvdh\Cors\ServiceProvider::class);
$app->configure('cors');
$app->routeMiddleware([
    'cors' => \Barryvdh\Cors\HandleCors::class,
]);

//$app->register(\Neomerx\CorsIlluminate\Providers\LumenServiceProvider::class);

//$app->register(Laravel\Passport\PassportServiceProvider::class);
//$app->register(Dusterio\LumenPassport\PassportServiceProvider::class);

$app->register(Illuminate\Mail\MailServiceProvider::class);
$app->configure('mail');
$app->configure('services');

$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);
$app->register(Dingo\Api\Provider\LumenServiceProvider::class);
$app->register(App\Providers\AppServiceProvider::class);

// Dingo API


app('Dingo\Api\Auth\Auth')->extend('jwt', function ($app) {
   return new Dingo\Api\Auth\Provider\JWT($app['Tymon\JWTAuth\JWTAuth']);
});

//Dingo\Api\Http\Response::addFormatter('json', new Dingo\Api\Http\Response\Format\Jsonp);

//$app['Dingo\Api\Exception\Handler']->setErrorFormat([
//    'error' => [
//        'message' => ':message',
//        'errors' => ':errors',
//        'code' => ':code',
//        'status_code' => ':status_code',
//        'debug' => ':debug'
//    ]
//]);

app('Dingo\Api\Transformer\Factory')->setAdapter(function ($app) {
    return new Dingo\Api\Transformer\Adapter\Fractal(new League\Fractal\Manager, 'include', ',');
});

app('Dingo\Api\Transformer\Factory')->register('User', 'UserTransformer');
//app('Dingo\Api\Transformer\Factory')->register('Role', 'RoleTransformer');

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    require __DIR__.'/../routes/web.php';
});

return $app;
