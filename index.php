<?php

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => realpath(__DIR__ .'/web'), // view
));
/* $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
		'driver'     => 'pdo_mysql',
		'dbname'     => 'samp_manager_db',
		'user'       => 'root',
		'password'   => ''),
));
*/
$app->get('/', function () use ($app){
  return $app['twig']->render('main.tpl', array(
        'path' => 'http://'.$_SERVER['SERVER_NAME'].'/web',
    ));
}); 
//var_dump(new Silex\Provider);
/* $app->match('/auth', function(){
	return 'ad';
}); */
$app->run();
