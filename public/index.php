<?php
   if (!session_id()) @session_start();

   ini_set('display_errors', 'on');

   require "../vendor/autoload.php";



   $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
      $r->addRoute('GET', '/', ['App\controllers\HomeController', 'home']);
      $r->addRoute('GET', '/404', ['App\controllers\HomeController', 'NOT_FOUND']);

      $r->addRoute(['GET','POST'], '/create_user', ['App\controllers\UserController', 'create_user']);
      $r->addRoute('GET', '/user_profile', ['App\controllers\UserController', 'page_profile']);
      $r->addRoute(['GET', 'POST'], '/edit/{id:\d+}', ['App\controllers\UserController', 'edit_profile']);
      $r->addRoute(['GET', 'POST'], '/status/{id:\d+}', ['App\controllers\UserController', 'status_profile']);
      $r->addRoute('GET', '/delete/{id:\d+}', ['App\controllers\UserController', 'delete']);
      $r->addRoute(['GET', 'POST'], '/avatar/{id:\d+}', ['App\controllers\UserController', 'avatar']);

      $r->addRoute(['GET', 'POST'], '/security/{id:\d+}', ['App\controllers\UserController', 'security']);
      $r->addRoute(['GET', 'POST'], '/login', ['App\controllers\RegisterController', 'login']);
      $r->addRoute(['GET', 'POST'], '/register', ['App\controllers\RegisterController', 'register']);
      $r->addRoute('GET', '/exit', ['App\controllers\RegisterController', 'exit']);
      $r->addRoute('GET', '/profile', ['App\controllers\ProfileController', 'profile']);
      $r->addRoute('POST', '/profile', ['App\controllers\ProfileController', 'EditNameAndEmail']);
      //$r->addRoute(['GET', 'POST'], '/changepassword', ['App\controllers\ProfileController', 'changepassword']);

      
      // {id} must be a number (\d+)
      //$r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
      // The /{title} suffix is optional
      //$r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
   });

   // Fetch method and URI from somewhere
   $httpMethod = $_SERVER['REQUEST_METHOD'];
   $uri = $_SERVER['REQUEST_URI'];

   // Strip query string (?foo=bar) and decode URI
   if (false !== $pos = strpos($uri, '?')) {
      $uri = substr($uri, 0, $pos);
   }
   $uri = rawurldecode($uri);






   $containerBuilder = new DI\ContainerBuilder();
   $containerBuilder->addDefinitions('../app/ConfigDI/ConfigDI.php');
   $container = $containerBuilder->build();

   //d($container);die; 


   $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
   switch ($routeInfo[0]) {
      case FastRoute\Dispatcher::NOT_FOUND:
         // ... 404 Not Found
         $container->call(['App\controllers\HomeController', 'NOT_FOUND']);
         break;
      case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
         // ... 405 Method Not Allowed
         $container->call(['App\controllers\HomeController', 'NOT_ALLOWED']);
         break;
      case FastRoute\Dispatcher::FOUND:
         //d( $routeInfo['1']);die;

         $Object = $routeInfo['1']['0'];
         $Method = $routeInfo['1']['1'];
         $var = $routeInfo['2'];

         $container->call([$Object, $Method], [$var]);
         break;
   }
