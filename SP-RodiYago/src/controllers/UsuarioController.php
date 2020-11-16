<?php 

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Usuario; // Obj que va a manipular la base de datos usuarios.
use Exception;

class UsuarioController {

    // Funciones para el PARCIAL!
    // JWT
    public function loginUser ( Request $request, Response $response ) {

        $body = $request->getParsedBody();
        $emailBody = $body['email'];
        $claveBody = $body['clave'];
        // echo json_encode($body);
        
        $rta= Usuario::where('email','=',$emailBody)->where('clave','=',$claveBody)->get()->first();

        if ( $rta ) {

            $rta = $rta->getOriginal();
            $bool = false;
            // echo json_encode( $rta );

            if ( $rta['clave'] === $claveBody && $rta['email'] === $emailBody ) {

                $bool = true;
                $payload = [
                    'id' => $rta['id'],
                    'email' => $rta['email'],
                    'tipo' => $rta['tipo']
                ];
                // echo json_encode( $payload );


                $token = AuthJWT::Login( $payload );

                // TOKEN!!!
                print_r($token);

            }

            if( !$bool ) { $response->getBody()->write( 'clave o email incorrectos.' ); }

        } else {

            echo 'No existe un usuario con ese ID';

        }

        return $response;

    }

    // -------------------------------------------------------------------
    // -------------------------------------------------------------------
    // -------------------------------------------------------------------

    // Funciones CRUD
    public function getAllUsers ( Request $request, Response $response ) {
    
        $rta = Usuario::get();     

        $response->getBody()->write( json_encode( $rta ) );

        return $response;

    }

    public function getOneUser ( Request $request, Response $response, $args ) {
    
        $rta = Usuario::find( $args['id'] ); // pq no use el int val?

        $response->getBody()->write( json_encode( $rta ) );

        return $response;
        
    }

    public function addUser ( Request $request, Response $response ) {

        $user = new Usuario;
        $user['nombre'] = $request->getParsedBody()['nombre'] ?? '';
        $user['clave'] = $request->getParsedBody()['clave'] ?? '';
        $user['tipo'] = $request->getParsedBody()['tipo'] ?? '';
        $user['email'] = $request->getParsedBody()['email'] ?? '';

        // echo json_encode($user);

        $rta = $user->save();
        $response->getBody()->write( json_encode( $rta ) );

        return $response;
        
    }

    public function updateUser ( Request $request, Response $response, $args ) {
    
        // Si el payload dice que soy admin puedo hacer todo,
        // si soy alumno puedo cambiar el email y
        // si yo profesor puedo cambiar email y materias dictadas.
        try {
            
            $tokenHeader = $request->getHeader( 'token' )[0]; // string

            if ( !$tokenHeader ) {

                $response = new Response();
                $response->getBody()->write( 'TOKEN INVALIDO' );
                
                return $response->withStatus( 401 );

            } else {

                $idUrl = $args['id'] ?? '';
                $user = Usuario::find( intval( $idUrl ) );

                $jwtDecodificado = AuthJWT::ValidarToken( $tokenHeader );
                $tipoUsuario = $jwtDecodificado->data->tipo; // string
                // echo $tipoUsuario . '<br/>';

                switch ( $tipoUsuario ) {
                    case 'admin': // Puedo hacer todo
                        $email = $request->getParsedBody()['email'] ?? '';

                        if ( $email ) {
                            $user['email'] = $request->getParsedBody()['email'] ?? '';
                        }
                        break;
                    
                    default:
                        # code...
                        break;
                }

                $rta = $user->save();
                $response->getBody()->write( json_encode( $rta ) );
                return $response;

            }
            

        } catch (\Throwable $e) {

            throw new Exception( $e->getMessage() );

        }
        
    }

    public function deleteUser ( Request $request, Response $response, $args ) {
    
        $idUrl = $args['id'] ?? '';
        $user = Usuario::find( intval( $idUrl ) );
        echo json_encode($user);


        // $rta = $user->delete();
        // $response->getBody()->write( json_encode( $rta ) );
        
        return $response;
        
    }

    // -------------------------------------------------------------------
    // -------------------------------------------------------------------
    // -------------------------------------------------------------------

    // Funciones CRUD
    // public function getAllUsers ( Request $request, Response $response ) {
    
    //     $rta = Usuario::get();     

    //     $response->getBody()->write( json_encode( $rta ) );

    //     return $response;

    // }

    // public function getOneUser ( Request $request, Response $response, $args ) {
    
    //     $rta = Usuario::find( $args['id'] );

    //     $response->getBody()->write( json_encode( $rta ) );

    //     return $response;
        
    // }

    // public function addUser ( Request $request, Response $response ) {

    //     // var_dump($request->getParsedBody());

    //     $user = new Usuario;
    //     $user->clave = $request->getParsedBody()['clave'] ?? '';
    //     $user->email = $request->getParsedBody()['email'] ?? '';
    //     $user->tipo = $request->getParsedBody()['tipo'] ?? '';
    //     // echo $user->$clave . '<br/>';
    //     // echo $user->$email . '<br/>';
    //     // echo $user->$tipo . '<br/>';

    //     $rta = $user->save();
    //     $response->getBody()->write( json_encode( $rta ) );

    //     return $response;
        
    // }

    // public function updateUser ( Request $request, Response $response, $args ) {
    
    //     // var_dump( $args['id'] );
    //     $idUrl = $args['id'] ?? '';
    //     $user = Usuario::find( intval( $idUrl ) );
    //     // echo json_encode( $user );

    //     // Hago las modicaciones y vuelvo a guardar
    //     $user->clave = $request->getParsedBody()['clave'] ?? '';
    //     $user->email = $request->getParsedBody()['email'] ?? '';
    //     $user->tipo = $request->getParsedBody()['tipo'] ?? '';
    
    //     $rta = $user->save();
    //     $response->getBody()->write( json_encode( $rta ) );
        
    //     return $response;
        
        
    // }

    // public function deleteUser ( Request $request, Response $response, $args ) {
    
    //     $idUrl = $args['id'] ?? '';
    //     $user = Usuario::find( intval( $idUrl ) );
    //     echo json_encode($user);


    //     // $rta = $user->delete();
    //     // $response->getBody()->write( json_encode( $rta ) );
        
    //     return $response;
        
    // }
    
}