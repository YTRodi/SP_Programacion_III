<?php

// Slim
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

// Controllers
use Config\Database;
use App\Controllers\UsuarioController;
use App\Controllers\MateriaController;
use App\Controllers\InscripcionController;


// Middleware
use App\Middleware\JsonMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\AuthAllMiddleware;

require __DIR__ . '/../vendor/autoload.php';


$conn = new Database;

$app = AppFactory::create();
$app->setBasePath( '/SP-RodiYago/public' );
// const ARRAY_ROLES = [ 'alumno', 'profesor', 'admin' ];


$app->group( '/users', function ( RouteCollectorProxy $group ) {

    // Traer todos
    // $group->get( '[/]', UsuarioController::class . ':getAllUsers' );

    // Punto 1
    $group->post( '[/]', UsuarioController::class . ':addUser' );

})->add( new JsonMiddleware );


// Punto 2
$app->post( '/login[/]', UsuarioController::class . ':loginUser' );


// Punto 3
$app->post( '/materia[/]', MateriaController::class . ':addMateria' )
    ->add( new AuthMiddleware( 'admin' ) )
    ->add( new JsonMiddleware );

// Punto 4
$app->post( '/inscripcion/{id}', InscripcionController::class . ':addInscripcion' )
    ->add( new AuthMiddleware( 'alumno' ) );


// Punto 5
$app->put( '/notas/{id}', InscripcionController::class . ':addNotaAlumno' )
    ->add( new AuthMiddleware( 'profesor' ) );


// Punto 7
$app->get( '/materia[/]', MateriaController::class . ':getAllMaterias' )
    ->add( new JsonMiddleware );

// Punto 8
$app->put( '/notas/{id}', InscripcionController::class . ':getNotasMateria' );


$app->addBodyParsingMiddleware(); // Para poder usar los datos que enviamos desde el body para el PUT ( vamos por 'x-www-form-urlencoded', no por form-data)
$app->run();