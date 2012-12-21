<?php
require_once __DIR__.'/vendor/autoload.php';
$app = new Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => realpath(__DIR__ .'/web'), // view
)); 
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
		'driver'     => 'pdo_mysql',
		'dbname'     => 'samp_manager_db',
		'user'       => 'root',
		'password'   => ''),
));
$app['debug'] = true;
spl_autoload_register(function ($class) use ($app){
	include_once(__DIR__ .'/source/'.$class.'.php');   

});

$app['Account'] = function ($app) {
    return new Account($app['db']);
};

//var_dump($app['Account']);

 $app->get('/', function () use ($app){
  return $app['twig']->render('main.tpl', array(
        'path' => 'http://'.$_SERVER['SERVER_NAME'].'/web',
    ));
});

$app->run();