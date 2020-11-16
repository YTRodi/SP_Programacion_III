<?php 
// Mismo nombre que la tabla que voy a manejar

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model {

    // public $nombre;
    // public $cuatrimestre;
    // public $cupos;

    // public function __construct( $nombre, $cuatrimestre, $cupos ) {
        
    //     $this->nombre = $nombre;
    //     $this->cuatrimestre = $cuatrimestre;
    //     $this->cupos = $cupos;

    // }

    public function __get($name){ return $this->$name; }
    public function __set($name, $value){ $this->$name = $value; }
}

