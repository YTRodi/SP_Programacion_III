<?php 

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Inscripcione;
use App\Models\Usuario;
use App\Models\Materia;


class InscripcionController {

    // Funciones CRUD
    public function getAllInscripciones ( Request $request, Response $response ) {
    
        $rta = Inscripcione::get();     

        $response->getBody()->write( json_encode( $rta ) );

        return $response;

    }

    public function getOneInscripcion ( Request $request, Response $response, $args ) {
    
        $rta = Inscripcione::find( $args['id'] ); // pq no use el int val?

        $response->getBody()->write( json_encode( $rta ) );

        return $response;
        
    }


    public function addInscripcion ( Request $request, Response $response, $args ) {

        // MATERIA
        $idUrl = intval( $args['id'] ?? '' ); 
        

        $materia = Materia::find( $idUrl );
        $cuposMaterias = $materia['cupos'];
        // echo json_encode($materia);
        // echo $cuposMaterias;

        
        if ( !$materia ) {
            
            $response->getBody()->write( 'No existe ese id' );

        } else {

            // USUARIO
            // tengo que recuperar el id del alumno!
            $tokenHeader = $request->getHeader( 'token' )[0]; // string
            $jwtDecodificado = AuthJWT::ValidarToken( $tokenHeader );
            // echo json_encode($jwtDecodificado);
            $idToken = intval( $jwtDecodificado->data->id );
            $user = Usuario::find( intval( $idToken ) );
            // echo json_encode($user);

            
            // LÓGICA:
            // si inscribo a un alumno, los cupos de las materias tienen que disminuir (update materia)
            // echo gettype($cuposMaterias);

            if ( $cuposMaterias > 0 ) {
                
                // Disminuyo los cupos de las materias

                // Hago las modicaciones y vuelvo a guardar
                // echo ' CUPOS ANTES: '.$materia['cupos'];
                $materia['cupos'] = $materia['cupos'] - 1;
                // echo ' CUPOS DESPUES: '.$materia['cupos'];
            
                $rta1 = $materia->save();
                $response->getBody()->write( json_encode( $rta1 ) );

                // Hago la inscripción.
                $inscripcion = new Inscripcione;
                $inscripcion['id_alumno'] = $idToken; // id usuario
                $inscripcion['id_materia'] = $idUrl; // id materia
                // echo json_encode($inscripcion);

                $rta = $inscripcion->save();
                $response->getBody()->write( json_encode( $rta ) );
                
            } else {

                $resp = new Response();
                $resp->getBody()->write( 'NO HAY MÁS CUPOS' );
                
                return $resp;

            }

        }

        return $response;
        
    }

    public function addNotaAlumno ( Request $request, Response $response, $args ) {

        // LOS DATOS LOS PASO POR 'x-www-form-urlencoded' !

        // LÓGICA: Tengo que traer las inscripciones
        $nota = intval( $request->getParsedBody()['nota'] ?? '' );
        $idAlumno = intval($request->getParsedBody()['idAlumno'] ?? '');

        $idMateria = intval( $args['id'] ?? '' ); 
        $inscripcion = Inscripcione::get();
        $notaAlumno = $inscripcion[0]['nota_alumno'];

        $inscripcionPorNotaAlumno = Inscripcione::where('nota_alumno','=',$notaAlumno)->where('id_alumno','=',$idAlumno)->get()->first();
        // echo json_encode($inscripcionPorNotaAlumno);

        $inscripcionPorNotaAlumno['nota_alumno'] = $nota;
        // echo json_encode($inscripcionPorNotaAlumno);

        $rta = $inscripcionPorNotaAlumno->save();
        $response->getBody()->write( json_encode( $rta ) );
        
        return $response;
    }

    public function getNotasMateria ( Request $request, Response $response, $args ) {


    }




    public function deleteInscripcion ( Request $request, Response $response, $args ) {
    
        $idUrl = $args['id'] ?? '';
        $user = Inscripcione::find( intval( $idUrl ) );
        echo json_encode($user);


        // $rta = $user->delete();
        // $response->getBody()->write( json_encode( $rta ) );
        
        return $response;
        
    }

}