<?php 

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Materia;


class MateriaController {

    public function addMateria ( Request $request, Response $response ) {

        $materia = new Materia;

        $materia['materia'] = $request->getParsedBody()['materia'] ?? '';
        $materia['cuatrimestre'] = $request->getParsedBody()['cuatrimestre'] ?? '';
        $materia['cupos'] = intval( $request->getParsedBody()['cupos'] ?? '' );
        // echo json_encode($materia);

        $rta = $materia->save();
        $response->getBody()->write( json_encode( $rta ) );

        return $response;
        
    }

    public function getAllMaterias ( Request $request, Response $response ) {
    
        $rta = Materia::get();  
           
        $response->getBody()->write( json_encode( $rta ) );

        return $response;

    }

}